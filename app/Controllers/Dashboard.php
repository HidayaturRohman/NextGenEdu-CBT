<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\MasterModel;
class Dashboard extends BaseController
{
 protected $dashboardModel;
 protected $masterModel;
 public function __construct()
 {
 $this->dashboardModel = new DashboardModel();
 $this->masterModel = new MasterModel();
 }
 /**
 * Ambil pengumuman/post untuk admin
 */
 public function getpost()
 {
 goto L_9d6ad;
 L_0dbb9:
 $_0xae9d = 5;
 goto L_2c871;
 L_60563:
 $_0xe8c3 = $_0xd3ff->get()->getResult();
 goto L_560e9;
 L_ccc14:
 return $this->response->setJSON($_0xe8c3);
 L_68e5d:
 $_0xd3ff->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157\x2c\40\x28\123\x45\114\x45\103\x54\40\x43\117\x55\116\x54\50\x70\157\x73\164\x5f\143\x6f\155\x6d\145\x6e\164\x73\56\x69\144\x5f\143\x6f\155\x6d\145\x6e\164\x29\40\x46\122\x4f\115\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x20\127\x48\105\x52\105\x20\141\x2e\151\x64\137\x70\157\x73\164\x20\75\x20\160\x6f\163\x74\137\x63\157\x6d\155\x65\156\x74\163\x2e\151\x64\137\x70\157\x73\164\x29\40\x41\123\x20\152\x6d\154");
 goto L_5ba42;
 L_560e9:
 $_0xff9f = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_04f51;
 L_ceb4b:
 $_0xc2c4 = \Config\Database::connect();
 goto L_9142f;
 L_71282:
 $_0xd3ff->limit($_0xae9d, $_0xd0c0);
 goto L_60563;
 L_9142f:
 $_0xd3ff = $_0xc2c4->table("\x70\157\x73\164\x20\141");
 goto L_68e5d;
 L_2c871:
 $_0xd0c0 = (int) $_0x4c6e * $_0xae9d;
 goto L_ceb4b;
 L_5ba42:
 $_0xd3ff->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x20\75\x20\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164");
 goto L_78064;
 L_04f51:
 if (count($_0xe8c3) > 0) {
 foreach ($_0xe8c3 as $_0xe6e6) {
 if ($_0xe6e6->dari > 0) {
 $_0xa90a = FCPATH . ltrim($_0xe6e6->foto ?? '', "\x2f");
 $_0xe6e6->foto = $_0xe6e6->foto && file_exists($_0xa90a) ? $_0xff9f . ltrim($_0xe6e6->foto, "\x2f") : $_0xff9f . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\147\x75\162\x75\56\x70\156\x67";
 }
 }
 }
 goto L_ccc14;
 L_78064:
 $_0xd3ff->orderBy("\x61\56\x75\160\x64\141\x74\145\x64", "\x64\145\x73\143");
 goto L_71282;
 L_9d6ad:
 $_0x4c6e = $this->request->getGet("\x68\141\x6c\141\x6d\141\x6e") ?? 0;
 goto L_0dbb9;
 }
 public function admin_box($_0x5fdd, $_0x262b, $_0x49e8)
 {
 goto L_9a14f;
 L_365b6:
 if ($_0x5fdd->jenjang == "\x31") {
 $_0xc557 = "\x6a\145\x6e\152\x61\156\x67\75\x30\40\x4f\122\x20\152\x65\156\x6a\141\x6e\147\x3d\61";
 } elseif ($_0x5fdd->jenjang == "\x32") {
 $_0xc557 = "\x6a\145\x6e\152\x61\156\x67\75\x32\40\x4f\122\x20\152\x65\156\x6a\141\x6e\147\x3d\61";
 }
 goto L_73f20;
 L_dc86c:
 $_0x25d2 = \Config\Database::connect();
 goto L_056aa;
 L_908e1:
 $_0x25d2 = \Config\Database::connect();
 goto L_dc86c;
 L_056aa:
 return json_decode(json_encode($_0xc11e), FALSE);
 L_73f20:
 $_0xc11e = [["\x62\157\x78" => "\x62\154\x75\145", "\x74\157\x74\141\x6c" => $this->masterModel->getSiswaTotalPage($_0x262b, $_0x49e8, "\x30"), "\x74\151\x74\154\x65" => "\x53\151\x73\167\x61", "\x75\162\x6c" => "\x64\141\x74\141\x73\151\x73\167\x61", "\x69\143\x6f\156" => "\x75\163\x65\162\x73"], ["\x62\157\x78" => "\x63\171\x61\156", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163", "id_tp='{$_0x262b}' AND id_smt='{$_0x49e8}'"), "\x74\151\x74\154\x65" => "\x52\157\x6d\142\x65\154", "\x75\162\x6c" => "\x64\141\x74\141\x6b\145\x6c\141\x73", "\x69\143\x6f\156" => "\x62\145\x6c\154"], ["\x62\157\x78" => "\x74\145\x61\154", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75"), "\x74\151\x74\154\x65" => "\x47\165\x72\165", "\x75\162\x6c" => "\x64\141\x74\141\x67\165\x72\165", "\x69\143\x6f\156" => "\x75\163\x65\162"], ["\x62\157\x78" => "\x66\165\x63\150\x73\151\x61", "\x74\157\x74\141\x6c" => $this->dashboardModel->totalWaliKelas($_0x262b, $_0x49e8), "\x74\151\x74\154\x65" => "\x57\141\x6c\151\x20\113\x65\154\x61\163", "\x75\162\x6c" => "\x64\141\x74\141\x6b\145\x6c\141\x73", "\x69\143\x6f\156" => "\x75\163\x65\162"], ["\x62\157\x78" => "\x73\165\x63\143\x65\163\x73", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154"), "\x74\151\x74\154\x65" => "\x4d\141\x70\145\x6c", "\x75\162\x6c" => "\x64\141\x74\141\x6d\141\x70\145\x6c", "\x69\143\x6f\156" => "\x62\157\x6f\153"], ["\x62\157\x78" => "\x79\145\x6c\154\x6f\167", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x6d\141\x73\164\x65\162\x5f\145\x6b\163\x74\162\x61"), "\x74\151\x74\154\x65" => "\x45\153\x73\164\x72\141\x6b\165\x72\151\x6b\165\x6c\145\x72", "\x75\162\x6c" => "\x64\141\x74\141\x65\153\x73\164\x72\141", "\x69\143\x6f\156" => "\x62\157\x6f\153"]];
 goto L_908e1;
 L_9a14f:
 $_0xc557 = '';
 goto L_365b6;
 }
 public function ujian_box($_0x5641, $_0xd78c)
 {
 $_0x5817 = [["\x62\157\x78" => "\x69\156\x64\151\x67\157", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x63\142\x74\137\x72\165\x61\156\x67"), "\x74\151\x74\154\x65" => "\x52\165\x61\156\x67", "\x75\162\x6c" => "\x63\142\x74\162\x75\141\x6e\147", "\x69\143\x6f\156" => "\x73\143\x68\157\x6f\154"], ["\x62\157\x78" => "\x6d\141\x72\157\x6f\156", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x63\142\x74\137\x73\145\x73\151"), "\x74\151\x74\154\x65" => "\x53\145\x73\151", "\x75\162\x6c" => "\x63\142\x74\163\x65\163\x69", "\x69\143\x6f\156" => "\x63\154\x6f\143\x6b"], ["\x62\157\x78" => "\x67\162\x65\145\x6e", "\x74\157\x74\141\x6c" => $this->dashboardModel->total("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c"), "\x74\151\x74\154\x65" => "\x42\141\x6e\153\x20\123\x6f\141\x6c", "\x75\162\x6c" => "\x63\142\x74\142\x61\156\x6b\163\x6f\141\x6c", "\x69\143\x6f\156" => "\x66\157\x6c\144\x65\162"], ["\x62\157\x78" => "\x74\145\x61\154", "\x74\157\x74\141\x6c" => $this->dashboardModel->totalJadwal($_0x5641, $_0xd78c), "\x74\151\x74\154\x65" => "\x4a\141\x64\167\x61\154", "\x75\162\x6c" => "\x63\142\x74\152\x61\144\x77\141\x6c", "\x69\143\x6f\156" => "\x63\154\x6f\143\x6b"]];
 return json_decode(json_encode($_0x5817), FALSE);
 }
 public function index()
 {
 goto L_623e1;
 L_4a344:
 $_0x274a["\x6d\141\x70\145\x6c\163"] = $_0xe1ae["\x6d\141\x70\145\x6c\163"];
 goto L_5fc5a;
 L_623e1:
 $_0x5476 = session();
 goto L_ebf7b;
 L_b3840:
 if ($_0x944d == "\x33") {
 // Siswa
 $_0x5e4a = $this->dashboardModel->getDataSiswa($_0xb2e9["\x66\151\x72\163\x74\137\x6e\141\x6d\145"], $_0xa6bd->id_tp ?? null, $_0x65a8->id_smt ?? null);
 if (!$_0x5e4a) {
 return view("\x64\151\x73\141\x62\154\x65\137\x6c\157\x67\151\x6e", $_0x274a);
 }
 $_0x274a["\x6c\157\x67\151\x6e"] = $_0x274a["\x73\151\x73\167\x61"] = $_0x5e4a;
 $_0x274a["\x6d\145\x6e\165"] = $this->menu_siswa_box($_0x321f->fitur_jadwal ?? "\x31");
 // TODO: get jadwals
 $_0x274a["\x6a\141\x64\167\x61\154\x73"] = [];
 // Placeholder until I migrate elearning->getJadwalHarian
 $_0x274a["\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164"] = $this->dashboardModel->getRunningText();
 $_0xb3b9 = new \App\Models\BannerModel();
 $_0x274a["\x62\141\x6e\156\x65\162\x73"] = $_0xb3b9->getActiveBanners();
 // LMS Feature: Ambil daftar Tugas & Materi aktif semester ini untuk kelas siswa
 $_0xeffa = [];
 if (!empty($_0x5e4a->id_kelas)) {
 try {
 $_0xee2a = \Config\Database::connect();
 $_0xeffa = $_0xee2a->table("\x6b\145\x6c\141\x73\137\x6a\141\x64\167\x61\154\x5f\155\x61\164\x65\162\x69\40\x61")->select("\x61\56\x69\144\x5f\153\x6a\155\x2c\40\x61\56\x69\144\x5f\155\x61\164\x65\162\x69\54\x20\141\x2e\152\x61\144\x77\141\x6c\137\x6d\141\x74\145\x72\151\x2c\40\x61\56\x6a\145\x6e\151\x73\54\x20\142\x2e\152\x75\144\x75\154\x5f\155\x61\164\x65\162\x69\54\x20\142\x2e\153\x6f\144\x65\137\x6d\141\x74\145\x72\151\x2c\40\x63\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x2c\40\x63\56\x6b\157\x64\145\x20\141\x73\40\x6b\157\x64\145\x5f\155\x61\160\x65\154\x2c\40\x64\56\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\146\x2e\154\x6f\147\x5f\164\x69\155\x65\54\x20\146\x2e\146\x69\156\x69\163\x68\137\x74\151\x6d\145\x2c\40\x66\56\x6e\151\x6c\141\x69\54\x20\146\x2e\143\x61\164\x61\164\x61\156\x2c\40\x66\56\x75\154\x61\156\x67")->join("\x6b\145\x6c\141\x73\137\x6d\141\x74\145\x72\151\x20\142", "\x61\56\x69\144\x5f\155\x61\164\x65\162\x69\75\x62\56\x69\144\x5f\155\x61\164\x65\162\x69\40\x41\116\x44\40\x62\56\x73\164\x61\164\x75\163\x3d\61")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x62\56\x69\144\x5f\155\x61\160\x65\154\x3d\143\x2e\151\x64\137\x6d\141\x70\145\x6c", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x64", "\x62\56\x69\144\x5f\147\x75\162\x75\75\x64\56\x69\144\x5f\147\x75\162\x75", "\x6c\145\x66\164")->join("\x6c\157\x67\137\x6d\141\x74\145\x72\151\x20\146", "\x61\56\x69\144\x5f\153\x6a\155\x3d\146\x2e\151\x64\137\x6d\141\x74\145\x72\151\x20\101\x4e\104\x20\146\x2e\151\x64\137\x73\151\x73\167\x61\75" . $_0xee2a->escape($_0x5e4a->id_siswa), "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\164\x70", $_0xa6bd->id_tp ?? 1)->where("\x61\56\x69\144\x5f\163\x6d\164", $_0x65a8->id_smt ?? 1)->where("\x61\56\x69\144\x5f\153\x65\154\x61\163", $_0x5e4a->id_kelas)->orderBy("\x61\56\x6a\145\x6e\151\x73", "\x44\105\x53\103")->orderBy("\x61\56\x69\144\x5f\153\x6a\155", "\x44\105\x53\103")->limit(6)->get()->getResult();
 } catch (\Throwable $_0x98ee) {
 }
 }
 $_0x274a["\x74\165\x67\141\x73\137\x6c\155\x73"] = $_0xeffa;
 return view("\x6d\145\x6d\142\x65\162\x73\57\x73\151\x73\167\x61\57\x64\141\x73\150\x62\157\x61\162\x64", $_0x274a);
 } elseif ($_0x944d == "\x32") {
 // Guru
 $_0x9534 = $this->dashboardModel->getDataGuruByUserId($_0x5476->get("\x69\144\x5f\165\x73\145\x72"), $_0xa6bd->id_tp ?? null, $_0x65a8->id_smt ?? null);
 if (!$_0x9534) {
 return view("\x64\151\x73\141\x62\154\x65\137\x6c\157\x67\151\x6e", $_0x274a);
 }
 $_0x274a["\x73\145\x73\163\x69\157\x6e"] = $_0x274a["\x67\165\x72\165"] = $_0x9534;
 $_0x274a["\x69\156\x66\157\x5f\142\x6f\170"] = $this->admin_box($_0x321f, $_0xa6bd->id_tp ?? null, $_0x65a8->id_smt ?? null);
 $_0x274a["\x75\152\x69\141\x6e\137\x62\157\x78"] = $this->ujian_box($_0xa6bd->id_tp ?? null, $_0x65a8->id_smt ?? null);
 $_0xfd91 = new \App\Models\CbtModel();
 $_0xc9c8 = $_0xfd91->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 $_0xcd9f = is_array($_0xc9c8) ? count($_0xc9c8) : 0;
 $_0x274a["\x74\157\x6b\145\x6e"] = $this->getValidToken($_0xcd9f);
 $_0x274a["\x61\144\x61\137\x75\152\x69\141\x6e"] = $_0xc9c8 ?: [];
 $_0xe1ae = ["\x6a\141\x64\167\x61\154\x5f\153\x62\155" => []];
 $_0x274a["\x6a\141\x64\167\x61\154\x5f\153\x62\155"] = $_0xe1ae["\x6a\141\x64\167\x61\154\x5f\153\x62\155"];
 $_0x274a["\x6d\141\x70\145\x6c\163"] = $_0xe1ae["\x6d\141\x70\145\x6c\163"];
 $_0x274a["\x6b\145\x6c\141\x73\145\x73"] = $_0xe1ae["\x6b\145\x6c\141\x73\145\x73"];
 $_0x274a["\x74\151\x6d\145\x73"] = $_0xe1ae["\x74\151\x6d\145\x73"];
 return view("\x6d\145\x6d\142\x65\162\x73\57\x67\165\x72\165\x2f\144\x61\163\x68\142\x6f\141\x72\144", $_0x274a);
 }
 goto L_d54b2;
 L_e4203:
 $_0x65a8 = $this->dashboardModel->getSemesterActive();
 goto L_8bf20;
 L_f7d3e:
 $_0x274a["\x75\152\x69\141\x6e\137\x62\157\x78"] = $this->ujian_box($_0xa6bd->id_tp ?? null, $_0x65a8->id_smt ?? null);
 goto L_d87da;
 L_12d97:
 $_0x274a["\x69\156\x66\157\x5f\142\x6f\170"] = $this->admin_box($_0x321f, $_0xa6bd->id_tp ?? null, $_0x65a8->id_smt ?? null);
 goto L_f7d3e;
 L_414f9:
 $_0x274a["\x6a\141\x64\167\x61\154\x5f\153\x62\155"] = $_0xe1ae["\x6a\141\x64\167\x61\154\x5f\153\x62\155"];
 goto L_4a344;
 L_ebf7b:
 if (!$_0x5476->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to("\x61\165\x74\150\x2f\154\x6f\147\x69\156");
 }
 goto L_2db50;
 L_5fc5a:
 $_0x274a["\x6b\145\x6c\141\x73\145\x73"] = $_0xe1ae["\x6b\145\x6c\141\x73\145\x73"];
 goto L_3a275;
 L_3a275:
 $_0x274a["\x74\151\x6d\145\x73"] = $_0xe1ae["\x74\151\x6d\145\x73"];
 goto L_12d97;
 L_64c6e:
 $_0xb2e9 = ["\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x5476->get("\x75\163\x65\162\x6e\141\x6d\145"), "\x72\157\x6c\145\x5f\156\x61\155\x65" => $_0x5476->get("\x72\157\x6c\145\x5f\156\x61\155\x65"), "\x66\157\x74\157" => $_0x5476->get("\x66\157\x74\157") ?? ''];
 goto L_47eb4;
 L_8bf20:
 $_0x274a = ["\x75\163\x65\162" => $_0xb2e9, "\x6a\165\x64\165\x6c" => "\x42\145\x72\141\x6e\144\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x48\141\x6c\141\x6d\141\x6e\40\x55\164\x61\155\x61", "\x73\145\x74\164\x69\156\x67" => $_0x321f, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xa6bd, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x65a8];
 goto L_77d39;
 L_5b3cf:
 $_0xc9c8 = $_0xfd91->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_835d0;
 L_90912:
 $_0x274a["\x74\157\x6b\145\x6e"] = $this->getValidToken($_0xcd9f);
 goto L_b9f8a;
 L_d87da:
 return view("\x64\141\x73\150\x62\157\x61\162\x64\57\x69\156\x64\145\x78", $_0x274a);
 L_2494e:
 $_0xe1ae = ["\x6a\141\x64\167\x61\154\x5f\153\x62\155" => []];
 goto L_414f9;
 L_b9f8a:
 $_0x274a["\x61\144\x61\137\x75\152\x69\141\x6e"] = $_0xc9c8 ?: [];
 goto L_2494e;
 L_2db50:
 $_0x321f = $this->dashboardModel->getSetting();
 goto L_64c6e;
 L_47eb4:
 $_0xa6bd = $this->dashboardModel->getTahunActive();
 goto L_e4203;
 L_77d39:
 $_0x944d = $_0x5476->get("\x72\157\x6c\145");
 goto L_b3840;
 L_d54b2:
 // Admin
 $_0xfd91 = new \App\Models\CbtModel();
 goto L_5b3cf;
 L_835d0:
 $_0xcd9f = is_array($_0xc9c8) ? count($_0xc9c8) : 0;
 goto L_90912;
 }
 public function checkTokenJadwal()
 {
 goto L_70f0e;
 L_2b8da:
 $_0x1de6 = $this->getValidToken($_0x8339);
 goto L_7eff5;
 L_7eff5:
 return $this->response->setJSON(["\x74\157\x6b\145\x6e" => $_0x1de6, "\x61\144\x61\137\x75\152\x69\141\x6e" => $_0x8339]);
 L_0b089:
 $_0xbf14 = $_0x1d44->getDataJadwalByTgl(date("\x59\55\x6d\55\x64"));
 goto L_b1c44;
 L_b1c44:
 $_0x8339 = is_array($_0xbf14) ? count($_0xbf14) : 0;
 goto L_2b8da;
 L_70f0e:
 $_0x1d44 = new \App\Models\CbtModel();
 goto L_0b089;
 }
 public function getLog()
 {
 goto L_c4c04;
 L_e0620:
 $_0xb959 = $_0xaf95->getCountLog($_0x7113, $_0x5e88);
 goto L_2cdd9;
 L_b84c4:
 $_0x7113 = $this->request->getGet("\x73\145\x61\162\x63\150");
 goto L_e0620;
 L_bcdcc:
 if ($_0x5b47 < 1) {
 $_0x5b47 = 15;
 }
 goto L_4c037;
 L_c4c04:
 $_0xaf95 = new \App\Models\LogModel();
 goto L_4b0d8;
 L_2cdd9:
 $_0x873e = $_0xaf95->getLog($_0x2971, $_0x5b47, $_0x7113, $_0x5e88);
 goto L_f48b1;
 L_136f6:
 if ($_0x8636 < 1) {
 $_0x8636 = 1;
 }
 goto L_9ca12;
 L_9ca12:
 $_0x5b47 = (int) ($this->request->getGet("\x6c\151\x6d\151\x74") ?? 15);
 goto L_bcdcc;
 L_4b0d8:
 $_0x8636 = (int) ($this->request->getGet("\x70\141\x67\145") ?? 1);
 goto L_136f6;
 L_f48b1:
 $_0xc25d = is_array($_0xb959) || $_0xb959 instanceof \Countable ? count($_0xb959) : (int) $_0xb959;
 goto L_254c8;
 L_4c037:
 $_0x5e88 = $this->request->getGet("\x66\151\x6c\164\x65\162");
 goto L_71f3a;
 L_71f3a:
 $_0x2971 = ($_0x8636 - 1) * $_0x5b47;
 goto L_b84c4;
 L_254c8:
 return $this->addPhotos($_0x873e, $_0xc25d);
 }
 private function addPhotos($_0x8e88, $_0xf618)
 {
 goto L_05f22;
 L_37317:
 if (count($_0xf43f) > 0) {
 $_0x7103 = $_0x2e69->allGuru($_0xf43f);
 }
 goto L_6db9b;
 L_e1e5a:
 $_0x19a3 = [];
 goto L_957dc;
 L_74b76:
 if (count($_0x3fcd) > 0) {
 $_0x986a = $_0x2e69->allSiswa($_0x3fcd);
 }
 goto L_37317;
 L_206f1:
 $_0x3fcd = [];
 goto L_e1e5a;
 L_05f22:
 $_0x2e69 = new \App\Models\AuthModel();
 goto L_d522d;
 L_6db9b:
 if (count($_0x19a3) > 0) {
 $_0xe045 = $_0x2e69->all_profiles($_0x19a3);
 }
 goto L_ca983;
 L_d522d:
 $_0xf43f = [];
 goto L_206f1;
 L_957dc:
 foreach ($_0x8e88 as $_0xe0b4) {
 if ($_0xe0b4->id_group == "\x32") {
 if (isset($_0xe0b4->id_user) && !in_array($_0xe0b4->id_user, $_0xf43f)) {
 $_0xf43f[] = $_0xe0b4->id_user;
 }
 } elseif ($_0xe0b4->id_group == "\x33") {
 if (isset($_0xe0b4->id_user) && !in_array($_0xe0b4->id_user, $_0x3fcd)) {
 $_0x3fcd[] = $_0xe0b4->id_user;
 }
 } else if (isset($_0xe0b4->id_user) && !in_array($_0xe0b4->id_user, $_0x19a3)) {
 $_0x19a3[] = $_0xe0b4->id_user;
 }
 }
 goto L_74b76;
 L_ca983:
 $_0x7374 = ["\x73\151\x73\167\x61" => $_0x986a ?? [], "\x67\165\x72\165" => $_0x7103 ?? [], "\x6c\157\x67\163" => array_values($_0x8e88), "\x61\144\x6d\151\x6e\163" => $_0xe045 ?? [], "\x74\157\x74\141\x6c" => $_0xf618];
 goto L_8a333;
 L_8a333:
 return $this->response->setJSON($_0x7374);
 }
 public function hapusLog($_0xcf84 = "\x61\154\x6c")
 {
 goto L_21316;
 L_1a6ae:
 if ($_0xcf84 == "\x61\154\x6c") {
 $_0xf39a->table("\x6c\157\x67")->emptyTable();
 // Since emptyTable doesn't return boolean on success universally, we check transStatus later
 $_0xb9bf = ["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x62\145\x72\150\x61\163\x69\154"];
 } elseif ($_0xcf84 == "\x73\145\x6c\145\x63\164\x65\144") {
 $_0xad2a = $this->request->getGet("\x69\144\x73");
 $_0xf39a->table("\x6c\157\x67")->whereIn("\x69\144\x5f\154\x6f\147", $_0xad2a)->delete();
 $_0xb9bf = ["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x62\145\x72\150\x61\163\x69\154"];
 } else {
 $_0xf39a->table("\x6c\157\x67")->where("\x69\144\x5f\154\x6f\147", $_0xcf84)->delete();
 $_0xb9bf = ["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x62\145\x72\150\x61\163\x69\154"];
 }
 goto L_e8ef3;
 L_1adc4:
 $_0xf39a->transStart();
 goto L_1a6ae;
 L_21316:
 $_0xf39a = \Config\Database::connect();
 goto L_1adc4;
 L_e8ef3:
 $_0xf39a->transComplete();
 goto L_50600;
 L_650f6:
 return $this->response->setJSON($_0xb9bf);
 L_50600:
 if (!$_0xf39a->transStatus()) {
 $_0xb9bf = ["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x67\141\x67\141\x6c"];
 }
 goto L_650f6;
 }
 public function menu_siswa_box($_0xccea = "\x31")
 {
 goto L_e5e44;
 L_ebe1c:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x4e\151\x6c\141\x69\40\x48\141\x73\151\x6c", "\x69\143\x6f\156" => "\x69\143\x5f\145\x78\141\x6d\56\x70\156\x67", "\x6c\151\x6e\153" => "\x6b\142\x6d\57\x68\141\x73\151\x6c"];
 goto L_173d3;
 L_e5e44:
 $_0x8e5f = [];
 goto L_80356;
 L_80356:
 if ($_0xccea != "\x30") {
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x4a\141\x64\167\x61\154\x20\120\x65\154\x61\152\x61\162\x61\156", "\x69\143\x6f\156" => "\x69\143\x5f\157\x6e\154\x69\156\x65\56\x70\156\x67", "\x6c\151\x6e\153" => "\x6b\142\x6d\57\x6a\141\x64\167\x61\154\x5f\160\x65\154\x61\152\x61\162\x61\156"];
 }
 goto L_ddd2f;
 L_ddd2f:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x4d\141\x74\145\x72\151", "\x69\143\x6f\156" => "\x69\143\x5f\145\x6c\145\x61\162\x6e\151\x6e\147\x2e\160\x6e\147", "\x6c\151\x6e\153" => "\x6b\142\x6d\57\x6d\141\x74\145\x72\151"];
 goto L_0cf46;
 L_0cf46:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x54\165\x67\141\x73", "\x69\143\x6f\156" => "\x69\143\x5f\161\x75\145\x73\164\x69\157\x6e\163\x2e\160\x6e\147", "\x6c\151\x6e\153" => "\x6b\142\x6d\57\x74\165\x67\141\x73"];
 goto L_a525d;
 L_3ad28:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x45\55\x50\145\x72\160\x75\163", "\x69\143\x6f\156" => "\x69\143\x5f\157\x6e\154\x69\156\x65\137\x6c\151\x62\162\x61\162\x79\56\x70\156\x67", "\x6c\151\x6e\153" => "\x73\151\x73\167\x61\57\x70\145\x72\160\x75\163"];
 goto L_f23dd;
 L_f23dd:
 return json_decode(json_encode($_0x8e5f), FALSE);
 L_a525d:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x55\152\x69\141\x6e\40\x2f\40\x55\154\x61\156\x67\141\x6e", "\x69\143\x6f\156" => "\x69\143\x5f\161\x75\145\x73\164\x69\157\x6e\56\x70\156\x67", "\x6c\151\x6e\153" => "\x63\142\x74\163\x69\163\x77\141\x2f\143\x62\164"];
 goto L_ebe1c;
 L_306ea:
 try {
 $_0x83f0 = \Config\Database::connect();
 if ($_0x83f0->tableExists("\x70\162\x65\163\x65\156\x73\151\x5f\163\x65\164\x74\151\x6e\147")) {
 $_0x8051 = $_0x83f0->table("\x70\162\x65\163\x65\156\x73\151\x5f\163\x65\164\x74\151\x6e\147")->get()->getRow();
 if ($_0x8051 && !empty($_0x8051->pkl_aktif)) {
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x50\162\x61\153\x65\162\x69\156\x20\57\x20\120\x4b\114", "\x69\143\x6f\156" => "\x69\143\x5f\157\x6e\154\x69\156\x65\56\x70\156\x67", "\x6c\151\x6e\153" => "\x70\153\x6c\57\x73\151\x73\167\x61"];
 }
 }
 } catch (\Throwable $_0x7bfd) {
 }
 goto L_fdb24;
 L_fdb24:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x43\141\x74\141\x74\141\x6e\40\x47\165\x72\165", "\x69\143\x6f\156" => "\x69\143\x5f\163\x74\165\x64\145\x6e\164\x2e\160\x6e\147", "\x6c\151\x6e\153" => "\x73\151\x73\167\x61\57\x63\141\x74\141\x74\141\x6e"];
 goto L_33e4c;
 L_173d3:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x50\162\x65\163\x65\156\x73\151\x20\123\x69\163\x77\141", "\x69\143\x6f\156" => "\x69\143\x5f\143\x6c\151\x70\142\x6f\141\x72\144\x2e\160\x6e\147", "\x6c\151\x6e\153" => "\x6b\142\x6d\57\x6b\145\x68\141\x64\151\x72\141\x6e"];
 goto L_306ea;
 L_33e4c:
 $_0x8e5f[] = ["\x74\151\x74\154\x65" => "\x41\162\x73\151\x70", "\x69\143\x6f\156" => "\x69\143\x5f\144\x6f\143\x75\155\x65\156\x74\56\x70\156\x67", "\x6c\151\x6e\153" => "\x6b\142\x6d\57\x61\162\x73\151\x70"];
 goto L_3ad28;
 }
 public function getjadwalhariini($_0x5e63, $_0x4cc5)
 {
 goto L_59e7b;
 L_59e7b:
 $_0x7071 = $this->dashboardModel->getTahunActive();
 goto L_eced8;
 L_e3fd8:
 $_0x7949 = isset($_0xb049[$_0x5e63]) ? array_values($_0xb049[$_0x5e63]) : [];
 goto L_3270e;
 L_3270e:
 return $this->response->setJSON($_0x7949);
 L_eced8:
 $_0xf1bc = $this->dashboardModel->getSemesterActive();
 goto L_c358a;
 L_35717:
 $_0xb049 = $_0xa19b->getJadwalHarian($_0x7071->id_tp ?? 1, $_0xf1bc->id_smt ?? 1, $_0x4cc5, $_0x5e63);
 goto L_e3fd8;
 L_c358a:
 $_0xa19b = new \App\Models\ElearningModel();
 goto L_35717;
 }
 /**
 * Mempersiapkan data Jadwal KBM Hari Ini untuk widget Dashboard (Admin & Guru)
 */
 private function getJadwalKbmHariIni($_0x1b1c, $_0x81d6, $_0x5952 = "\x31", $_0x983d = null)
 {
 goto L_3c4ed;
 L_e3f2f:
 $_0x2c24 = $_0x471c->get()->getResult();
 goto L_979ee;
 L_4d43b:
 foreach ($_0xce04 as $_0xa20a) {
 $_0x3c38 = $_0xa20a->id_kelas;
 if ($_0x6315 !== null && !in_array($_0x3c38, $_0x6315)) {
 continue;
 }
 if (!isset($_0xf5de[$_0x3c38])) {
 $_0xf5de[$_0x3c38] = $_0xa20a->nama_kelas ?? $_0x9744[$_0x3c38] ?? "\x4b\145\x6c\141\x73\40" . $_0x3c38;
 }
 $_0x9f09[$_0x3c38][] = $_0xa20a;
 if (!empty($_0xa20a->dari)) {
 $_0xcd7d = substr($_0xa20a->dari, 0, 5);
 if ($_0xcd7d < $_0x4873) {
 $_0x4873 = $_0xcd7d;
 }
 }
 if (!empty($_0xa20a->sampai)) {
 $_0x1773 = substr($_0xa20a->sampai, 0, 5);
 if ($_0x1773 > $_0x5ebf) {
 $_0x5ebf = $_0x1773;
 }
 }
 }
 goto L_6d9aa;
 L_8eea7:
 // 1 = Senin, ..., 7 = Minggu
 $_0x9a0c = \Config\Database::connect();
 goto L_d69cb;
 L_5d42b:
 // Ambil info master kelas_jadwal_kbm jika ada
 $_0x5ad2 = $_0x9a0c->table("\x6b\145\x6c\141\x73\137\x6a\141\x64\167\x61\154\x5f\153\x62\155")->where("\x69\144\x5f\164\x70", $_0x71a4)->where("\x69\144\x5f\163\x6d\164", $_0xa06b)->get()->getResult();
 goto L_9675a;
 L_211a8:
 $_0x4873 = "\x30\67\x3a\60\x30";
 goto L_58b31;
 L_6d9aa:
 // Fallback jika setelah filter guru kosong, tampilkan seluruh kelas yang ada jadwal
 if (empty($_0x9f09)) {
 foreach ($_0xce04 as $_0xa20a) {
 $_0x3c38 = $_0xa20a->id_kelas;
 if (!isset($_0xf5de[$_0x3c38])) {
 $_0xf5de[$_0x3c38] = $_0xa20a->nama_kelas ?? $_0x9744[$_0x3c38] ?? "\x4b\145\x6c\141\x73\40" . $_0x3c38;
 }
 $_0x9f09[$_0x3c38][] = $_0xa20a;
 if (!empty($_0xa20a->dari)) {
 $_0xcd7d = substr($_0xa20a->dari, 0, 5);
 if ($_0xcd7d < $_0x4873) {
 $_0x4873 = $_0xcd7d;
 }
 }
 if (!empty($_0xa20a->sampai)) {
 $_0x1773 = substr($_0xa20a->sampai, 0, 5);
 if ($_0x1773 > $_0x5ebf) {
 $_0x5ebf = $_0x1773;
 }
 }
 }
 }
 goto L_5d42b;
 L_ecdc6:
 // 3. Generate timeslots 5 menit
 $_0xf8f6 = [];
 goto L_4ad47;
 L_07044:
 $_0xea72 = new \DateTime($_0x4873);
 goto L_d844e;
 L_59086:
 foreach ($_0x9f09 as $_0x3c38 => $_0xb4bf) {
 $_0x147b = [];
 $_0x6a60 = "\x32\63\x3a\65\x30";
 $_0x68b1 = "\x30\61\x3a\60\x30";
 $_0x63a1 = "\x30";
 foreach ($_0xb4bf as $_0x5a02) {
 $_0x86bf = !empty($_0x5a02->dari) ? substr($_0x5a02->dari, 0, 5) : "\x30\67\x3a\60\x30";
 $_0x7ad2 = !empty($_0x5a02->sampai) ? substr($_0x5a02->sampai, 0, 5) : "\x30\67\x3a\64\x35";
 $_0xbbfd = round(abs(strtotime($_0x7ad2) - strtotime($_0x86bf)) / 60);
 if ($_0xbbfd <= 0) {
 $_0xbbfd = 45;
 }
 $_0x6178 = $_0x5a02->kode_mapel ?: ($_0x5a02->nama_mapel ?: '');
 if ($_0x63a1 !== "\x30" && $_0x5a02->id_mapel == $_0x63a1 && isset($_0x147b[$_0x6a60])) {
 $_0x147b[$_0x6a60]["\x72\157\x77\163"] += $_0xbbfd / 5;
 $_0x147b[$_0x6a60]["\x73\141\x6d\160\x61\151"] = $_0x7ad2;
 } else {
 $_0x63a1 = (string) $_0x5a02->id_mapel;
 $_0x6a60 = $_0x86bf;
 $_0x68b1 = $_0x7ad2;
 $_0x147b[$_0x86bf] = ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x5a02->id_jadwal, "\x64\141\x72\151" => $_0x86bf, "\x73\141\x6d\160\x61\151" => $_0x7ad2, "\x72\157\x77\163" => $_0xbbfd / 5, "\x69\144\x5f\153\x65\154\x61\163" => $_0x5a02->id_kelas, "\x69\144\x5f\150\x61\162\x69" => $_0x5a02->id_hari, "\x69\144\x5f\155\x61\160\x65\154" => (string) $_0x5a02->id_mapel, "\x6b\157\x64\145" => $_0x6178];
 }
 }
 $_0x37af = $_0x8df0[$_0x3c38] ?? (object) ["\x69\144\x5f\164\x70" => $_0x71a4, "\x69\144\x5f\163\x6d\164" => $_0xa06b, "\x69\144\x5f\153\x65\154\x61\163" => $_0x3c38, "\x6b\142\x6d\137\x6a\141\x6d\137\x70\145\x6c" => 45, "\x6b\142\x6d\137\x6a\141\x6d\137\x6d\165\x6c\141\x69" => $_0x4873, "\x6b\142\x6d\137\x6a\141\x6d\137\x73\145\x6c\145\x73\141\x69" => $_0x5ebf, "\x6b\142\x6d\137\x6a\155\x6c\137\x6d\141\x70\145\x6c\137\x68\141\x72\151" => count($_0xb4bf), "\x69\163\x74\151\x72\141\x68\141\x74" => [], "\x6c\151\x62\165\x72" => "\x37"];
 $_0x37af->detail = $_0x147b;
 $_0x5361[$_0x3c38] = $_0x37af;
 }
 goto L_ecdc6;
 L_3c4ed:
 $_0x71a4 = $_0x1b1c->id_tp ?? 1;
 goto L_84b71;
 L_33e8a:
 for ($_0x86c4 = 0; $_0x86c4 < $_0x6049 / 5; $_0x86c4++) {
 try {
 $_0x5ed7->add(new \DateInterval("\x50\124\x35\115"));
 $_0x3df3 = $_0xea72->format("\x48\72\x69");
 if (strpos($_0x3df3, "\x30\60") == 3 || strpos($_0x3df3, "\x33\60") == 3) {
 $_0xcfb3 = max(0, $_0x86c4 - 6);
 $_0x7f61 = isset($_0xf8f6[$_0xcfb3]["\x73\164\x61\162\x74"]) ? round(abs(strtotime($_0xf8f6[$_0xcfb3]["\x73\164\x61\162\x74"]) - strtotime($_0x3df3)) / 60, 2) : 0;
 if ($_0x7f61 <= 30 && isset($_0xf8f6[$_0xcfb3]["\x73\164\x61\162\x74"])) {
 $_0xf8f6[$_0xcfb3]["\x73\160\x61\156"] = $_0x7f61 / 5 * 2;
 }
 }
 $_0xf8f6[] = ["\x73\164\x61\162\x74" => $_0x3df3, "\x73\160\x61\156" => 12];
 $_0xea72->add(new \DateInterval("\x50\124\x35\115"));
 } catch (\Exception $_0x5fd7) {
 }
 }
 goto L_ae056;
 L_979ee:
 $_0x9744 = [];
 goto L_4f980;
 L_9d977:
 if ($_0x5952 == "\x32" && !empty($_0x983d)) {
 $_0x44f0 = new \App\Models\ElearningModel();
 $_0x6639 = $_0x44f0->getGuruMapelKelas($_0x983d, $_0x71a4, $_0xa06b);
 if (!empty($_0x6639->mapel_kelas)) {
 $_0x9624 = @unserialize($_0x6639->mapel_kelas);
 if (is_array($_0x9624)) {
 $_0x6134 = [];
 foreach ($_0x9624 as $_0x185a) {
 if (isset($_0x185a["\x6b\145\x6c\141\x73\137\x6d\141\x70\145\x6c"])) {
 foreach ($_0x185a["\x6b\145\x6c\141\x73\137\x6d\141\x70\145\x6c"] as $_0x5634) {
 if (!empty($_0x5634["\x6b\145\x6c\141\x73"])) {
 $_0x6134[$_0x5634["\x6b\145\x6c\141\x73"]] = true;
 }
 }
 }
 }
 if (!empty($_0x6134)) {
 $_0x6315 = array_keys($_0x6134);
 }
 }
 }
 }
 goto L_7de15;
 L_b5065:
 foreach ($_0x5ad2 as $_0x2ae0) {
 $_0x8df0[$_0x2ae0->id_kelas] = $_0x2ae0;
 }
 goto L_14499;
 L_84b71:
 $_0xa06b = $_0x81d6->id_smt ?? 1;
 goto L_68f1e;
 L_7de15:
 $_0xf5de = [];
 goto L_6e086;
 L_6e086:
 $_0x9f09 = [];
 goto L_211a8;
 L_24029:
 // Filter kelas untuk guru jika guru hanya mengajar kelas tertentu
 $_0x6315 = null;
 goto L_9d977;
 L_6567a:
 $_0xce04 = $_0xad0d->get()->getResult();
 goto L_63c24;
 L_63c24:
 if (empty($_0xce04)) {
 return ["\x6a\141\x64\167\x61\154\x5f\153\x62\155" => [], "\x6b\145\x6c\141\x73\145\x73" => [], "\x6d\141\x70\145\x6c\163" => [], "\x74\151\x6d\145\x73" => []];
 }
 goto L_24029;
 L_58b31:
 $_0x5ebf = "\x31\64\x3a\60\x30";
 goto L_4d43b;
 L_4ad47:
 $_0x6049 = round(abs(strtotime($_0x5ebf) - strtotime($_0x4873)) / 60, 2) + 5;
 goto L_07044;
 L_ae056:
 return ["\x6a\141\x64\167\x61\154\x5f\153\x62\155" => $_0x5361, "\x6b\145\x6c\141\x73\145\x73" => $_0xf5de, "\x6d\141\x70\145\x6c\163" => [], "\x74\151\x6d\145\x73" => $_0xf8f6];
 L_d69cb:
 // 1. Dapatkan daftar kelas yang relevan
 $_0x471c = $_0x9a0c->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->select("\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6e\141\x6d\141\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\164\x70", $_0x71a4)->where("\x69\144\x5f\163\x6d\164", $_0xa06b)->orderBy("\x6e\141\x6d\141\x5f\153\x65\154\x61\163", "\x41\123\x43");
 goto L_e3f2f;
 L_7d35d:
 // 2. Query jadwal mapel hari ini
 $_0xad0d = $_0x9a0c->table("\x6b\145\x6c\141\x73\137\x6a\141\x64\167\x61\154\x5f\155\x61\160\x65\154\x20\141")->select("\x61\56\x2a\54\x20\142\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\143\x2e\153\x6f\144\x65\40\x61\163\x20\153\x6f\144\x65\137\x6d\141\x70\145\x6c\54\x20\143\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\142", "\x62\56\x69\144\x5f\153\x65\154\x61\163\x3d\141\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x63\56\x69\144\x5f\155\x61\160\x65\154\x3d\141\x2e\151\x64\137\x6d\141\x70\145\x6c", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\164\x70", $_0x71a4)->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xa06b)->where("\x61\56\x69\144\x5f\150\x61\162\x69", $_0x5df3)->orderBy("\x61\56\x69\144\x5f\153\x65\154\x61\163", "\x41\123\x43")->orderBy("\x61\56\x64\141\x72\151", "\x41\123\x43")->orderBy("\x61\56\x6a\141\x6d\137\x6b\145", "\x41\123\x43");
 goto L_6567a;
 L_9675a:
 $_0x8df0 = [];
 goto L_b5065;
 L_14499:
 $_0x5361 = [];
 goto L_59086;
 L_4f980:
 foreach ($_0x2c24 as $_0xcbca) {
 $_0x9744[$_0xcbca->id_kelas] = $_0xcbca->nama_kelas;
 }
 goto L_7d35d;
 L_68f1e:
 $_0x5df3 = date("\x4e");
 goto L_8eea7;
 L_d844e:
 $_0x5ed7 = clone $_0xea72;
 goto L_33e8a;
 }
 public function get_status_siswa()
 {
 goto L_936c3;
 L_16f3c:
 foreach ($_0xb4b2 as &$_0x8bc4) {
 $_0x8bc4["\x73\151\x73\167\x61"] = ["\x69\144\x5f\163\x69\163\x77\141" => $_0x8bc4["\x69\144\x5f\163\x69\163\x77\141"], "\x6e\141\x6d\141" => $_0x8bc4["\x6e\141\x6d\141"], "\x6e\151\x73" => $_0x8bc4["\x6e\151\x73"], "\x6e\151\x73\156" => $_0x8bc4["\x6e\151\x73\156"], "\x61\147\x61\155\x61" => $_0x8bc4["\x61\147\x61\155\x61"]];
 $_0x8bc4["\x6b\145\x6c\141\x73"] = ["\x6b\157\x64\145\x5f\153\x65\154\x61\163" => $_0x8bc4["\x6b\157\x64\145\x5f\153\x65\154\x61\163"], "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x8bc4["\x6e\141\x6d\141\x5f\153\x65\154\x61\163"]];
 $_0x8bc4["\x72\165\x61\156\x67"] = ["\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x8bc4["\x6b\157\x64\145\x5f\162\x75\141\x6e\147"], "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x8bc4["\x6e\141\x6d\141\x5f\162\x75\141\x6e\147"]];
 $_0x8bc4["\x73\145\x73\151"] = ["\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x8bc4["\x6b\157\x64\145\x5f\163\x65\163\x69"], "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x8bc4["\x6e\141\x6d\141\x5f\163\x65\163\x69"]];
 $_0xee92[] = $_0x8bc4;
 }
 goto L_c8eb7;
 L_09f3c:
 $_0xf639 = $_0x52d8->id_tp ?? 1;
 goto L_40e44;
 L_20cc9:
 $_0xd5df["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e"] = $_0x8b31;
 goto L_5f673;
 L_7d35d:
 $_0xb416->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x20\75\x20\141\x2e\162\x75\141\x6e\147\x5f\151\x64");
 goto L_b061a;
 L_91062:
 $_0xd5df["\x63\142\x74\163\x69\163\x77\141"] = $_0x376a ? (array) $_0x376a : [];
 goto L_71e1a;
 L_fba9c:
 if (count($_0x1020) > 0) {
 $_0xb416->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x1020);
 }
 goto L_6b089;
 L_7a716:
 $_0xd61c = new \App\Models\DropdownModel();
 goto L_09f3c;
 L_fbe3e:
 $_0xd5df["\x67\165\x72\165\x73"] = $_0xd61c->getAllGuru();
 goto L_2952a;
 L_90df6:
 $_0x8b31 = [];
 goto L_4f1ca;
 L_2952a:
 $_0xd5df["\x6b\145\x6c\141\x73\145\x73"] = $_0xd61c->getAllKelas($_0xf639, $_0x3f95);
 goto L_a8413;
 L_8a3e6:
 $_0xea61 = \Config\Database::connect();
 goto L_69b5a;
 L_e1f4f:
 $_0xd5df["\x70\145\x6e\147\x61\167\x61\163"] = $_0xd224->getAllPengawas($_0xf639, $_0x3f95, null, null);
 goto L_fbe3e;
 L_4f1ca:
 $_0xee92 = [];
 goto L_11706;
 L_11706:
 $_0xd5df["\x74\157\x64\141\x79"] = $_0xcf24;
 goto L_e1f4f;
 L_e3789:
 $_0xb4b2 = $_0xb416->get()->getResultArray();
 goto L_16f3c;
 L_6c75e:
 foreach ($_0x1e7b as $_0xa00a) {
 $_0x1020[] = $_0xa00a->id_jadwal;
 $_0x6509 = $this->maybe_unserialize($_0xa00a->bank_kelas);
 $_0x7a65 = [];
 if ($_0x6509) {
 foreach ($_0x6509 as $_0x60c9) {
 $_0x28d6 = (array) $_0x60c9;
 if (isset($_0x28d6["\x6b\145\x6c\141\x73\137\x69\144"])) {
 $_0x7a65[] = strval($_0x28d6["\x6b\145\x6c\141\x73\137\x69\144"]);
 if ($_0x28d6["\x6b\145\x6c\141\x73\137\x69\144"]) {
 $_0x3b38[] = $_0x28d6["\x6b\145\x6c\141\x73\137\x69\144"];
 }
 } else if (is_scalar($_0x60c9)) {
 $_0x7a65[] = strval($_0x60c9);
 $_0x3b38[] = $_0x60c9;
 }
 }
 }
 $_0xa00a->bank_kelas = $_0x7a65;
 $_0xa00a->bank = (object) ["\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0xa00a->bank_kode ?? '', "\x62\141\x6e\153\x5f\153\x65\154\x61\163" => $_0x7a65, "\x73\157\x61\154\x5f\141\x67\141\x6d\141" => $_0xa00a->soal_agama ?? "\x2d", "\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144" => $_0xa00a->bank_guru_id ?? '', "\x6d\141\x70\145\x6c" => (object) ["\x6b\157\x64\145" => $_0xa00a->kode ?? '', "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xa00a->nama_mapel ?? '']];
 $_0x8b31[] = $_0xa00a;
 }
 goto L_7f3b3;
 L_7f3b3:
 $_0xf566 = $_0xd224->getDistinctSesi($_0xf639, $_0x3f95, $_0x3b38);
 goto L_7a6f2;
 L_ae885:
 $_0xb416->groupStart()->where("\x44\101\x54\105\x28\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x29\40\x3c\75", $_0xcf24)->where("\x44\101\x54\105\x28\141\x2e\164\x67\154\x5f\163\x65\154\x65\163\x61\151\x29\40\x3e\75", $_0xcf24)->orWhere("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", $_0xcf24)->orWhere("\x61\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69", $_0xcf24)->groupEnd();
 goto L_4acc3;
 L_02fd0:
 $_0x3b38 = [];
 goto L_90df6;
 L_6e0c2:
 if (isset($_0x52d8->id_tp) && isset($_0xbdfc->id_smt)) {
 $_0xb416->where("\x61\56\x69\144\x5f\164\x70", $_0x52d8->id_tp);
 $_0xb416->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xbdfc->id_smt);
 }
 goto L_ae885;
 L_5e85d:
 // Fallback 1: If no jadwals found for today, get any active jadwals (status=1)
 if (!$_0x1e7b) {
 $_0x6b69 = $_0xea61->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 $_0x6b69->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x61\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\141\x2e\163\x74\141\x74\165\x73\54\x20\141\x2e\152\x61\155\x5f\153\x65\54\x20" . "\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20" . "\x6d\56\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154");
 $_0x6b69->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 $_0x6b69->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 if (isset($_0x52d8->id_tp) && isset($_0xbdfc->id_smt)) {
 $_0x6b69->where("\x61\56\x69\144\x5f\164\x70", $_0x52d8->id_tp);
 $_0x6b69->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xbdfc->id_smt);
 }
 $_0x6b69->where("\x61\56\x73\164\x61\164\x75\163", "\x31");
 $_0x1e7b = $_0x6b69->get()->getResult();
 }
 goto L_4f6a9;
 L_b8598:
 $_0x1020 = [];
 goto L_6c75e;
 L_5f673:
 return $this->response->setJSON($_0xd5df);
 L_be8fe:
 $_0xd5df["\x61\162\x72\137\x6b\145\x6c\141\x73"] = $_0x3b38;
 goto L_20cc9;
 L_936c3:
 $_0x52d8 = $this->dashboardModel->getTahunActive();
 goto L_bce4c;
 L_54004:
 $_0xcf24 = date("\x59\55\x6d\55\x64");
 goto L_8a3e6;
 L_4acc3:
 $_0x1e7b = $_0xb416->get()->getResult();
 goto L_5e85d;
 L_a8413:
 if (!$_0x1e7b) {
 $_0xd5df["\x73\145\x73\151\x73\151\x73\167\x61"] = [];
 $_0xd5df["\x63\142\x74\163\x69\163\x77\141"] = [];
 $_0xd5df["\x72\165\x61\156\x67\163"] = [];
 $_0xd5df["\x61\162\x72\137\x6b\145\x6c\141\x73"] = [];
 $_0xd5df["\x6a\141\x64\167\x61\154\x73\137\x75\152\x69\141\x6e"] = [];
 return $this->response->setJSON($_0xd5df);
 }
 goto L_b8598;
 L_73696:
 $_0xb416->join("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\163", "\x73\56\x69\144\x5f\163\x69\163\x77\141\x20\75\x20\141\x2e\163\x69\163\x77\141\x5f\151\x64");
 goto L_6a4e5;
 L_e6b08:
 $_0xb416->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x61\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\141\x2e\163\x74\141\x74\165\x73\54\x20\141\x2e\152\x61\155\x5f\153\x65\54\x20" . "\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20" . "\x6d\56\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154");
 goto L_3c5dc;
 L_71e1a:
 $_0xd5df["\x72\165\x61\156\x67\163"] = array_values($_0xf566);
 goto L_be8fe;
 L_bce4c:
 $_0xbdfc = $this->dashboardModel->getSemesterActive();
 goto L_54004;
 L_26fc2:
 $_0xb416->select("\x61\56\x2a\54\x20\163\x2e\151\x64\137\x73\151\x73\167\x61\54\x20\163\x2e\156\x61\155\x61\54\x20\163\x2e\156\x69\163\x2c\40\x73\56\x6e\151\x73\156\x2c\40\x73\56\x61\147\x61\155\x61\54\x20\153\x2e\153\x6f\144\x65\137\x6b\145\x6c\141\x73\54\x20\153\x2e\156\x61\155\x61\137\x6b\145\x6c\141\x73\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x65\56\x6b\157\x64\145\x5f\163\x65\163\x69\54\x20\163\x65\56\x6e\141\x6d\141\x5f\163\x65\163\x69");
 goto L_73696;
 L_fe27e:
 $_0xb416 = $_0xea61->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141");
 goto L_26fc2;
 L_dd74c:
 $_0xd5df["\x73\145\x73\151\x73\151\x73\167\x61"] = $_0xee92;
 goto L_91062;
 L_6b089:
 $_0x376a = $_0xb416->get()->getResult();
 goto L_24b77;
 L_86254:
 if (count($_0x3b38) > 0) {
 $_0xb416->whereIn("\x61\56\x6b\145\x6c\141\x73\137\x69\144", $_0x3b38);
 }
 goto L_e3789;
 L_5b0bf:
 $_0xb416->select("\x69\144\x5f\142\x61\156\x6b\54\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\151\x64\137\x73\151\x73\167\x61\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x72\145\x73\145\x74\137\x77\141\x6b\164\x75\54\x73\145\x6c\145\x73\141\x69\54\x73\164\x61\164\x75\163");
 goto L_fba9c;
 L_b061a:
 $_0xb416->join("\x63\142\x74\137\x73\145\x73\151\x20\163\x65", "\x73\145\x2e\151\x64\137\x73\145\x73\151\x20\75\x20\141\x2e\163\x65\163\x69\137\x69\144");
 goto L_86254;
 L_63734:
 $_0xd224 = new \App\Models\CbtModel();
 goto L_7a716;
 L_69b5a:
 $_0xb416 = $_0xea61->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 goto L_e6b08;
 L_7a6f2:
 // Fallback for ruangs if empty
 if (empty($_0xf566)) {
 $_0x7e28 = $_0xea61->table("\x63\142\x74\137\x72\165\x61\156\x67")->get()->getResult();
 $_0xa5a0 = $_0xea61->table("\x63\142\x74\137\x73\145\x73\151")->get()->getResult();
 $_0xee72 = $_0xea61->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->get()->getResult();
 $_0xe07b = [];
 $_0x6509 = [];
 foreach ($_0xee72 as $_0x848b) {
 $_0xe07b[$_0x848b->id_kelas] = $_0x848b->nama_kelas;
 $_0x6509[] = $_0x848b->id_kelas;
 }
 $_0x26c2 = [];
 if ($_0x7e28 && $_0xa5a0) {
 foreach ($_0x7e28 as $_0xec39) {
 foreach ($_0xa5a0 as $_0x6152) {
 $_0xd623 = $_0x6152->id_sesi . "\x2d" . $_0xec39->id_ruang;
 $_0x26c2[$_0xd623] = (object) ["\x73\145\x73\151\x5f\151\x64" => $_0x6152->id_sesi, "\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x6152->kode_sesi, "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x6152->nama_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x6152->waktu_mulai ?? '', "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x6152->waktu_akhir ?? '', "\x72\165\x61\156\x67\137\x69\144" => $_0xec39->id_ruang, "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0xec39->kode_ruang, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0xec39->nama_ruang, "\x69\163\x74\151\x72\141\x68\141\x74" => $_0x6152->istirahat ?? "\x30", "\x6b\145\x6c\141\x73\137\x69\144" => $_0x6509, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0xe07b, "\x69\144\x73\137\x73\151\x73\167\x61" => [], "\x70\145\x73\145\x72\164\x61" => 0];
 }
 }
 }
 $_0xf566 = $_0x26c2;
 }
 goto L_fe27e;
 L_c8eb7:
 $_0xb416 = $_0xea61->table("\x63\142\x74\137\x73\151\x73\167\x61");
 goto L_5b0bf;
 L_3c5dc:
 $_0xb416->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 goto L_80c66;
 L_24b77:
 if ($_0x376a) {
 foreach ($_0x376a as $_0xefbc) {
 $_0xefbc->jadwal = new \stdClass();
 $_0xefbc->jadwal->id_jadwal = $_0xefbc->id_jadwal;
 }
 }
 goto L_dd74c;
 L_4f6a9:
 // Fallback 2: Get any jadwals in database
 if (!$_0x1e7b) {
 $_0xa235 = $_0xea61->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141");
 $_0xa235->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x74\160\x2c\40\x61\56\x69\144\x5f\163\x6d\164\x2c\40\x61\56\x69\144\x5f\142\x61\156\x6b\54\x20\141\x2e\151\x64\137\x6a\145\x6e\151\x73\54\x20\141\x2e\164\x67\154\x5f\155\x75\154\x61\151\x2c\40\x61\56\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69\54\x20\141\x2e\163\x74\141\x74\165\x73\54\x20\141\x2e\152\x61\155\x5f\153\x65\54\x20" . "\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61\54\x20\142\x2e\142\x61\156\x6b\137\x67\165\x72\165\x5f\151\x64\54\x20" . "\x6d\56\x6b\157\x64\145\x2c\40\x6d\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154");
 $_0xa235->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\40\x3d\40\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164");
 $_0xa235->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 $_0x1e7b = $_0xa235->get()->getResult();
 }
 goto L_63734;
 L_40e44:
 $_0x3f95 = $_0xbdfc->id_smt ?? 1;
 goto L_02fd0;
 L_80c66:
 $_0xb416->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x20\75\x20\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164");
 goto L_6e0c2;
 L_6a4e5:
 $_0xb416->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x20\75\x20\141\x2e\153\x65\154\x61\163\x5f\151\x64");
 goto L_7d35d;
 }
}