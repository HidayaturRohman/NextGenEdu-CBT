<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\CbtModel;
use App\Models\DashboardModel;
use App\Models\DropdownModel;
use App\Models\MasterModel;
use App\Models\KelasModel;
use App\Models\RaporModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
class Cbtcetak extends BaseController
{
 protected $dashboardModel;
 protected $cbtModel;
 protected $dropdownModel;
 protected $masterModel;
 protected $kelasModel;
 protected $raporModel;
 public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $_0xe10c)
 {
 goto L_0631c;
 L_70a6c:
 $this->cbtModel = new CbtModel();
 goto L_d0949;
 L_d0949:
 $this->dropdownModel = new DropdownModel();
 goto L_43d4d;
 L_961af:
 $this->kelasModel = new KelasModel();
 goto L_90a80;
 L_9720a:
 $this->dashboardModel = new DashboardModel();
 goto L_70a6c;
 L_43d4d:
 $this->masterModel = new MasterModel();
 goto L_961af;
 L_90a80:
 $this->raporModel = new RaporModel();
 L_0631c:
 parent::initController($request, $response, $_0xe10c);
 goto L_9720a;
 }
 protected function isLoggedIn()
 {
 $_0x3ec9 = session();
 return $_0x3ec9->get("\x69\163\x5f\154\x6f\147\x69\156") || $_0x3ec9->get("\x6c\157\x67\147\x65\144\x5f\151\x6e") || $_0x3ec9->has("\x69\144\x5f\165\x73\145\x72") || $_0x3ec9->has("\x69\144");
 }
 protected function isAdmin()
 {
 $_0xa7c0 = session();
 return in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x34"]) || $_0xa7c0->get("\x6c\145\x76\145\x6c") == "\x61\144\x6d\151\x6e" || $_0xa7c0->get("\x69\163\x5f\141\x64\155\x69\156") === true;
 }
 protected function inGroup($_0x416f)
 {
 goto L_fdcaa;
 L_fdcaa:
 $_0x4ea3 = session();
 goto L_abf91;
 L_abf91:
 $_0xb836 = $_0x4ea3->get("\x72\157\x6c\145");
 goto L_c62af;
 L_f6ba6:
 return false;
 L_c62af:
 if ($_0x416f === "\x67\165\x72\165") {
 return $_0xb836 == "\x32" || $_0x4ea3->get("\x6c\145\x76\145\x6c") === "\x67\165\x72\165";
 }
 goto L_f6ba6;
 }
 protected function getUserInfo()
 {
 $_0xa0ad = session();
 return (object) ["\x69\144" => $_0xa0ad->get("\x69\144\x5f\147\x75\162\x75") ?? $_0xa0ad->get("\x69\144\x5f\165\x73\145\x72") ?? $_0xa0ad->get("\x69\144") ?? 1, "\x75\163\x65\162\x6e\141\x6d\145" => $_0xa0ad->get("\x75\163\x65\162\x6e\141\x6d\145") ?? "\x61\144\x6d\151\x6e"];
 }
 private function checkAccess()
 {
 goto L_ca3f5;
 L_0d55c:
 return null;
 L_ca3f5:
 if (!$this->isLoggedIn()) {
 return redirect()->to("\x61\165\x74\150");
 }
 goto L_93767;
 L_93767:
 if (!$this->isAdmin() && !$this->inGroup("\x67\165\x72\165")) {
 throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("\x48\141\x6e\171\x61\40\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\40\x64\141\x6e\40\x47\165\x72\165\x20\171\x61\156\x67\40\x64\151\x69\172\x69\156\x6b\141\x6e\40\x6d\145\x6e\147\x61\153\x73\145\x73\40\x68\141\x6c\141\x6d\141\x6e\40\x69\156\x69\56");
 }
 goto L_0d55c;
 }
 protected function maybe_unserialize($_0xd2b6)
 {
 goto L_1ed44;
 L_526af:
 $_0x92f2 = json_decode(trim($_0xd2b6));
 goto L_68ba9;
 L_400b4:
 $_0x499b = @unserialize(trim($_0xd2b6));
 goto L_37938;
 L_37938:
 if ($_0x499b !== false || trim($_0xd2b6) === "\x62\72\x30\73") {
 return json_decode(json_encode($_0x499b));
 }
 goto L_526af;
 L_1ed44:
 if (is_array($_0xd2b6) || is_object($_0xd2b6)) {
 return $_0xd2b6;
 }
 goto L_6da90;
 L_6da90:
 if (!is_string($_0xd2b6) || trim($_0xd2b6) === '') {
 return [];
 }
 goto L_400b4;
 L_707fc:
 return $_0xd2b6;
 L_68ba9:
 if (json_last_error() === JSON_ERROR_NONE && (is_object($_0x92f2) || is_array($_0x92f2))) {
 return $_0x92f2;
 }
 goto L_707fc;
 }
 public function index()
 {
 goto L_492aa;
 L_c1b46:
 $_0x3eef = $this->dashboardModel->getSemesterActive();
 goto L_fdeb1;
 L_492aa:
 if ($_0x2f13 = $this->checkAccess()) {
 return $_0x2f13;
 }
 goto L_bb8cc;
 L_5eecb:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x64\141\x74\141", $_0xc79f);
 L_fdeb1:
 $_0xc79f = ["\x75\163\x65\162" => $_0x2003, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x44\141\x74\141\x20\120\x65\156\x69\154\x61\151\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x2146, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x3eef, "\x6b\157\x70" => $this->cbtModel->getSettingKopAbsensi(), "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_93061;
 L_bb8cc:
 $_0x2003 = $this->getUserInfo();
 goto L_a1e98;
 L_93061:
 if (!$this->isAdmin()) {
 $_0xc79f["\x67\165\x72\165"] = $this->dashboardModel->getDataGuruByUserId($_0x2003->id, $_0x2146->id_tp, $_0x3eef->id_smt);
 $_0xfdd4 = $this->cbtModel->getPengawasHariIni(date("\x59\55\x6d\55\x64"));
 $_0xc79f["\x70\145\x6e\147\x61\167\x61\163"] = $_0xfdd4;
 $_0x3065 = [];
 foreach ($_0xfdd4 as $_0x9198) {
 $_0x2bef = explode("\x2c", $_0x9198->id_guru ?? '');
 foreach ($_0x2bef as $_0x18fc) {
 $_0x18fc = trim($_0x18fc);
 if ($_0x18fc !== '' && !in_array($_0x18fc, $_0x3065)) {
 $_0x3065[] = $_0x18fc;
 }
 }
 }
 $_0xc79f["\x69\144\x73\137\x70\145\x6e\147\x61\167\x61\163"] = $_0x3065;
 }
 goto L_5eecb;
 L_a1e98:
 $_0x2146 = $this->dashboardModel->getTahunActive();
 goto L_c1b46;
 }
 public function kartuPeserta()
 {
 goto L_e242e;
 L_e242e:
 if ($_0x7339 = $this->checkAccess()) {
 return $_0x7339;
 }
 goto L_552e7;
 L_bb95e:
 $_0x75bb = ["\x75\163\x65\162" => $_0x7c29, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x4b\141\x72\164\x75\40\x50\145\x73\145\x72\164\x61", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x940f, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x12af, "\x6b\141\x72\164\x75" => $this->cbtModel->getSettingKartu(), "\x6b\145\x6c\141\x73" => $this->dropdownModel->getAllKelas($_0x940f->id_tp, $_0x12af->id_smt), "\x72\165\x61\156\x67" => $this->dropdownModel->getAllRuang(), "\x73\145\x74\164\x69\156\x67\137\x72\141\x70\157\x72" => $this->raporModel->getRaporSetting($_0x940f->id_tp, $_0x12af->id_smt), "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_0e28e;
 L_f50fa:
 $_0x12af = $this->dashboardModel->getSemesterActive();
 goto L_bb95e;
 L_ae84b:
 $_0x940f = $this->dashboardModel->getTahunActive();
 goto L_f50fa;
 L_22dc3:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x6b\141\x72\164\x75", $_0x75bb);
 L_0e28e:
 if (!$this->isAdmin()) {
 $_0x75bb["\x67\165\x72\165"] = $this->dashboardModel->getDataGuruByUserId($_0x7c29->id, $_0x940f->id_tp, $_0x12af->id_smt);
 }
 goto L_22dc3;
 L_552e7:
 $_0x7c29 = $this->getUserInfo();
 goto L_ae84b;
 }
 public function uploadFile($_0xbcac = "\x6c\157\x67\157\x5f\153\x61\162\x74\165")
 {
 goto L_99828;
 L_a404d:
 if ($_0x4fe1 && $_0x4fe1->isValid() && !$_0x4fe1->hasMoved()) {
 $_0xf629 = $_0x4fe1->guessExtension() ?: "\x70\156\x67";
 $_0x8491 = $_0xbcac . "\x2e" . $_0xf629;
 $_0x9319 = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f";
 if (!is_dir($_0x9319)) {
 @mkdir($_0x9319, 0777, true);
 }
 $_0x4fe1->move($_0x9319, $_0x8491, true);
 $_0x1ba7["\x73\164\x61\164\x75\163"] = true;
 $_0x1ba7["\x73\162\x63"] = base_url("\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . $_0x8491);
 $_0x1ba7["\x66\151\x6c\145\x6e\141\x6d\145"] = $_0x8491;
 $_0x1ba7["\x74\171\x70\145"] = $_0x4fe1->getClientMimeType();
 $_0x1ba7["\x73\151\x7a\145"] = $_0x4fe1->getSize();
 } else {
 $_0x1ba7["\x73\162\x63"] = $_0x4fe1 ? $_0x4fe1->getErrorString() : "\x4e\157\x20\146\x69\154\x65\40\x75\160\x6c\157\x61\144\x65\144";
 }
 goto L_81f69;
 L_99828:
 $_0x4fe1 = $this->request->getFile("\x6c\157\x67\157");
 goto L_27378;
 L_27378:
 $_0x1ba7 = ["\x73\164\x61\164\x75\163" => false, "\x73\162\x63" => ''];
 goto L_a404d;
 L_81f69:
 return $this->response->setJSON($_0x1ba7);
 }
 public function deleteFile()
 {
 goto L_ffbb2;
 L_cb482:
 if (file_exists($_0x2e7d) && is_file($_0x2e7d)) {
 @unlink($_0x2e7d);
 return $this->response->setBody("\x46\151\x6c\145\x20\104\x65\154\x65\164\x65\40\x53\165\x63\143\x65\163\x73\146\x75\154\x6c\171");
 }
 goto L_5f49b;
 L_8f85e:
 $_0xe82d = ltrim($_0xe82d, "\x2f");
 goto L_3b692;
 L_5f49b:
 return $this->response->setBody("\x46\151\x6c\145\x20\116\x6f\164\x20\106\x6f\165\x6e\144");
 L_31860:
 $_0xe82d = str_replace(base_url(), '', $_0xbaae ?? '');
 goto L_8f85e;
 L_3b692:
 $_0x2e7d = FCPATH . $_0xe82d;
 goto L_cb482;
 L_ffbb2:
 $_0xbaae = $this->request->getPost("\x73\162\x63");
 goto L_31860;
 }
 public function saveKartu()
 {
 goto L_63c9f;
 L_7bb7a:
 $_0x8361 = ["\x69\144\x5f\163\x65\164\x5f\153\x61\162\x74\165" => 123456, "\x68\145\x61\144\x65\162\x5f\61" => $_0x16ff, "\x68\145\x61\144\x65\162\x5f\62" => $_0x8ad3, "\x68\145\x61\144\x65\162\x5f\63" => $_0x4568, "\x68\145\x61\144\x65\162\x5f\64" => $_0x4800, "\x74\141\x6e\147\x67\141\x6c" => $_0xd09d];
 goto L_b1185;
 L_b1185:
 $_0xb685 = \Config\Database::connect()->table("\x63\142\x74\137\x6b\157\x70\137\x6b\141\x72\164\x75")->replace($_0x8361);
 goto L_c5551;
 L_71327:
 $_0x8ad3 = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\62");
 goto L_02c11;
 L_63c9f:
 $_0x16ff = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\61");
 goto L_71327;
 L_02c11:
 $_0x4568 = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\63");
 goto L_0992e;
 L_28ca2:
 $_0xd09d = $this->request->getPost("\x74\141\x6e\147\x67\141\x6c");
 goto L_7bb7a;
 L_c5551:
 return $this->response->setJSON($_0xb685);
 L_0992e:
 $_0x4800 = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\64");
 goto L_28ca2;
 }
 public function getSiswaKelas()
 {
 goto L_ef03c;
 L_190e1:
 $_0x349f = $this->dashboardModel->getSemesterActive();
 goto L_46a44;
 L_ccd99:
 if ($_0x87de === "\x61\154\x6c") {
 $_0x8332 = $this->kelasModel->getIdKelas($_0x5c31->id_tp, $_0x349f->id_smt);
 $_0x87de = $_0x8332;
 } else {
 $_0x8332 = $this->masterModel->getKelasById($_0x87de);
 $_0x87de = [$_0x87de];
 }
 goto L_7c076;
 L_50500:
 foreach ($_0x3297 as $_0x590b) {
 $_0x63b8 = array_filter(explode("\x2c", $_0x590b->id_guru ?? ''));
 if (!empty($_0x63b8)) {
 $_0xfe12 = $this->masterModel->getGuruByArrId($_0x63b8);
 }
 }
 goto L_33905;
 L_33905:
 $_0x7533 = $this->cbtModel->getRuangSiswaByKelas($_0x5c31->id_tp, $_0x349f->id_smt, $_0x87de, $_0xbbc6);
 goto L_10c8e;
 L_05e98:
 $_0x3297 = $this->cbtModel->getPengawasByJadwal($_0x5c31->id_tp, $_0x349f->id_smt, $_0x1b76, $_0xed8f);
 goto L_a95b7;
 L_10c8e:
 $_0x1040 = [];
 goto L_a7034;
 L_a4bc6:
 $_0x3863 = [];
 goto L_adb89;
 L_adb89:
 if ($_0x1b76 !== null && $_0x1b76 !== "\x6e\165\x6c\154" && $_0x1b76 !== '') {
 $_0x346a = $this->cbtModel->getJadwalById($_0x1b76, $_0xbbc6);
 if ($_0x346a) {
 $_0x346a->bank_kelas = $this->maybe_unserialize($_0x346a->bank_kelas ?? []);
 if (is_array($_0x346a->bank_kelas)) {
 foreach ($_0x346a->bank_kelas as $_0x535b) {
 $_0x4f3a = is_object($_0x535b) ? $_0x535b->kelas_id ?? null : (is_array($_0x535b) ? $_0x535b["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x535b);
 if ($_0x4f3a && !in_array($_0x4f3a, $_0x9597)) {
 $_0x9597[] = $_0x4f3a;
 }
 }
 }
 $_0x3863 = $this->cbtModel->getJadwalByTanggal($_0x346a->tgl_mulai);
 }
 }
 goto L_05e98;
 L_71505:
 $_0x3421 = ["\x73\151\x73\167\x61" => $_0x1040, "\x69\156\x66\157" => ["\x6b\145\x6c\141\x73" => $_0x8332, "\x73\145\x73\151" => $_0x1f46, "\x6a\141\x64\167\x61\154" => $_0x346a, "\x70\145\x6e\147\x61\167\x61\163" => $_0xfe12], "\x70\145\x6e\147\x61\167\x61\163" => $_0xfe12, "\x61\154\x6c\137\x70\145\x6e\147\x61\167\x61\163" => $_0x3297, "\x61\154\x6c\137\x73\145\x73\151" => array_values($_0x414f), "\x61\154\x6c\137\x74\147\x6c" => $_0x3863];
 goto L_74266;
 L_1838d:
 $_0x414f = [];
 goto L_1aee1;
 L_2cee7:
 $_0x346a = null;
 goto L_08cb5;
 L_08cb5:
 $_0x9597 = [];
 goto L_a4bc6;
 L_a7034:
 foreach ($_0x7533 as $_0x3a26) {
 $_0x141f = !empty($_0x3a26->foto) && file_exists(FCPATH . $_0x3a26->foto) ? $_0x3a26->foto : "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\163\x69\163\x77\141\x2e\160\x6e\147";
 $_0x3a26->foto = $_0x141f;
 $_0x1040[] = $_0x3a26;
 }
 goto L_1838d;
 L_74266:
 return $this->response->setJSON($_0x3421);
 L_a95b7:
 $_0xfe12 = [];
 goto L_50500;
 L_1aee1:
 if (count($_0x9597) > 0) {
 $_0x414f = \Config\Database::connect()->table("\x63\142\x74\137\x73\145\x73\151")->get()->getResult();
 }
 goto L_71505;
 L_46a44:
 $_0x87de = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_ccd99;
 L_7c076:
 $_0xbbc6 = !$_0xed8f ? null : $_0xed8f;
 goto L_6b7d3;
 L_6b7d3:
 $_0x1f46 = $_0xbbc6 ? $this->cbtModel->getSesiById($_0xbbc6) : null;
 goto L_2cee7;
 L_ef481:
 $_0x1b76 = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_e01d4;
 L_e01d4:
 $_0x5c31 = $this->dashboardModel->getTahunActive();
 goto L_190e1;
 L_ef03c:
 $_0xed8f = $this->request->getGet("\x73\145\x73\151");
 goto L_ef481;
 }
 public function getSiswaRuang()
 {
 goto L_6d3b7;
 L_605e6:
 $_0x61bd = ["\x61\154\x6c\137\x73\145\x73\151" => $_0x4622, "\x61\154\x6c\137\x74\147\x6c" => $_0xfd40, "\x61\154\x6c\137\x72\165\x61\156\x67" => array_values($_0xc70a), "\x61\154\x6c\137\x70\145\x6e\147\x61\167\x61\163" => $_0xc429, "\x70\145\x6e\147\x61\167\x61\163" => $_0xbb23, "\x61\154\x6c\137\x67\165\x72\165" => $this->dropdownModel->getAllGuru(), "\x73\151\x73\167\x61" => $this->cbtModel->getSiswaByRuang($_0x7071->id_tp, $_0x1fb2->id_smt, $_0x496c, $_0x10f9), "\x69\156\x66\157" => ["\x72\165\x61\156\x67" => $_0xd3e4, "\x73\145\x73\151" => $_0x7637, "\x6a\141\x64\167\x61\154" => $_0x9f55, "\x70\145\x6e\147\x61\167\x61\163" => $_0xbb23]];
 goto L_715d2;
 L_77642:
 if (count($_0x371e) > 0) {
 $_0x4622 = \Config\Database::connect()->table("\x63\142\x74\137\x73\145\x73\151")->get()->getResult();
 }
 goto L_f1767;
 L_37ec0:
 $_0x4622 = [];
 goto L_b482f;
 L_9e578:
 $_0x670b = $this->cbtModel->getPengawas($_0x7071->id_tp . $_0x1fb2->id_smt . $_0x279b . $_0x496c . $_0xb62f);
 goto L_7fb7f;
 L_715d2:
 return $this->response->setJSON($_0x61bd);
 L_8d17d:
 $_0x10f9 = $_0xb62f === "\x6e\165\x6c\154" || !$_0xb62f ? null : $_0xb62f;
 goto L_f841f;
 L_f841f:
 $_0x7637 = $_0x10f9 ? $this->cbtModel->getSesiById($_0x10f9) : null;
 goto L_e6d2f;
 L_7fb7f:
 $_0xbb23 = [];
 goto L_d2b5c;
 L_91412:
 $_0x1fb2 = $this->dashboardModel->getSemesterActive();
 goto L_9e578;
 L_e309a:
 $_0x7071 = $this->dashboardModel->getTahunActive();
 goto L_91412;
 L_0757e:
 $_0xb62f = $this->request->getGet("\x73\145\x73\151");
 goto L_a79ad;
 L_eb0a7:
 if ($_0x279b !== null && $_0x279b !== "\x6e\165\x6c\154" && $_0x279b !== '') {
 $_0x9f55 = $this->cbtModel->getJadwalById($_0x279b, $_0x10f9);
 if ($_0x9f55) {
 $_0xfd40 = $this->cbtModel->getJadwalByTanggal($_0x9f55->tgl_mulai);
 foreach ($_0xfd40 as $_0x3a6c) {
 $_0x1a2b = $this->maybe_unserialize($_0x3a6c->bank_kelas ?? []);
 if (is_array($_0x1a2b)) {
 $_0x3a6c->bank_kelas = array_map(function ($_0x44c0) {
 return (string) (is_object($_0x44c0) ? $_0x44c0->kelas_id ?? '' : (is_array($_0x44c0) ? $_0x44c0["\x6b\145\x6c\141\x73\137\x69\144"] ?? '' : $_0x44c0));
 }, $_0x1a2b);
 }
 }
 $_0x9f55->bank_kelas = $this->maybe_unserialize($_0x9f55->bank_kelas ?? []);
 if (is_array($_0x9f55->bank_kelas)) {
 foreach ($_0x9f55->bank_kelas as $_0x8fbd) {
 $_0x149a = (string) (is_object($_0x8fbd) ? $_0x8fbd->kelas_id ?? '' : (is_array($_0x8fbd) ? $_0x8fbd["\x6b\145\x6c\141\x73\137\x69\144"] ?? '' : $_0x8fbd));
 if ($_0x149a !== '' && !in_array($_0x149a, $_0x371e)) {
 $_0x371e[] = $_0x149a;
 }
 }
 }
 }
 }
 goto L_37ec0;
 L_4d435:
 foreach ($_0xc429 as $_0x4aa9) {
 $_0x26d0 = array_filter(explode("\x2c", $_0x4aa9->id_guru ?? ''));
 $_0x4aa9->guru = !empty($_0x26d0) ? $this->masterModel->getGuruByArrId($_0x26d0) : [];
 $_0x4aa9->pengawas = $_0x4aa9->guru;
 }
 goto L_605e6;
 L_e6d2f:
 $_0x9f55 = null;
 goto L_ccc53;
 L_d2b5c:
 if ($_0x670b && !empty($_0x670b->id_guru)) {
 $_0x5fb2 = array_filter(explode("\x2c", $_0x670b->id_guru));
 $_0xbb23 = $this->masterModel->getGuruByArrId($_0x5fb2);
 }
 goto L_89c2a;
 L_89c2a:
 $_0xd3e4 = $this->cbtModel->getRuangById($_0x496c);
 goto L_8d17d;
 L_72ef7:
 $_0x371e = [];
 goto L_eb0a7;
 L_ccc53:
 $_0xfd40 = [];
 goto L_72ef7;
 L_f1767:
 $_0xc429 = $this->cbtModel->getPengawasByJadwal($_0x7071->id_tp, $_0x1fb2->id_smt, $_0x279b ? [$_0x279b] : null, $_0x10f9, $_0x496c);
 goto L_4d435;
 L_6d3b7:
 $_0x496c = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_0757e;
 L_b482f:
 $_0xc70a = $this->cbtModel->getDistinctSesi($_0x7071->id_tp, $_0x1fb2->id_smt, $_0x371e);
 goto L_77642;
 L_a79ad:
 $_0x279b = $this->request->getGet("\x6a\141\x64\167\x61\154");
 goto L_e309a;
 }
 private function checkKopTableStructure($_0xaf31)
 {
 goto L_edd52;
 L_1d4bd:
 if (!$_0x7402->tableExists($_0xaf31)) {
 $_0x57e2->addField(["\x69\144\x5f\153\x6f\160" => ["\x74\171\x70\145" => "\x49\116\x54", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 11, "\x75\156\x73\151\x67\156\x65\144" => false, "\x61\165\x74\157\x5f\151\x6e\143\x72\145\x6d\145\x6e\164" => false], "\x68\145\x61\144\x65\162\x5f\61" => ["\x74\171\x70\145" => "\x54\105\x58\124", "\x6e\165\x6c\154" => true], "\x68\145\x61\144\x65\162\x5f\62" => ["\x74\171\x70\145" => "\x54\105\x58\124", "\x6e\165\x6c\154" => true], "\x68\145\x61\144\x65\162\x5f\63" => ["\x74\171\x70\145" => "\x54\105\x58\124", "\x6e\165\x6c\154" => true], "\x68\145\x61\144\x65\162\x5f\64" => ["\x74\171\x70\145" => "\x54\105\x58\124", "\x6e\165\x6c\154" => true], "\x68\145\x61\144\x65\162\x5f\153\x6f\160" => ["\x74\171\x70\145" => "\x54\105\x58\124", "\x6e\165\x6c\154" => true], "\x6b\157\x70\137\x6d\157\x64\145" => ["\x74\171\x70\145" => "\x56\101\x52\103\x48\101\x52", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 10, "\x64\145\x66\141\x75\154\x74" => "\x30", "\x6e\165\x6c\154" => true]]);
 $_0x57e2->addKey("\x69\144\x5f\153\x6f\160", true);
 $_0x57e2->createTable($_0xaf31, true);
 } else {
 $_0x803b = [];
 if (!$_0x7402->fieldExists("\x68\145\x61\144\x65\162\x5f\153\x6f\160", $_0xaf31)) {
 $_0x803b["\x68\145\x61\144\x65\162\x5f\153\x6f\160"] = ["\x74\171\x70\145" => "\x54\105\x58\124", "\x6e\165\x6c\154" => true];
 }
 if (!$_0x7402->fieldExists("\x6b\157\x70\137\x6d\157\x64\145", $_0xaf31)) {
 $_0x803b["\x6b\157\x70\137\x6d\157\x64\145"] = ["\x74\171\x70\145" => "\x56\101\x52\103\x48\101\x52", "\x63\157\x6e\163\x74\162\x61\151\x6e\164" => 10, "\x64\145\x66\141\x75\154\x74" => "\x30", "\x6e\165\x6c\154" => true];
 }
 if (!empty($_0x803b)) {
 $_0x57e2->addColumn($_0xaf31, $_0x803b);
 }
 }
 L_edd52:
 $_0x7402 = \Config\Database::connect();
 goto L_8903b;
 L_8903b:
 $_0x57e2 = \Config\Database::forge();
 goto L_1d4bd;
 }
 private function checkKopTables()
 {
 goto L_3b52f;
 L_5a3c9:
 $this->checkKopTableStructure("\x63\142\x74\137\x6b\157\x70\137\x62\145\x72\151\x74\141");
 goto L_35e7e;
 L_3b52f:
 $this->checkKopTableStructure("\x63\142\x74\137\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69");
 goto L_5a3c9;
 L_35e7e:
 $this->checkKopTableStructure("\x63\142\x74\137\x6b\157\x70\137\x70\145\x6e\147\x61\167\x61\163");
 goto L_6851d;
 L_6851d:
 $this->checkKopTableStructure("\x63\142\x74\137\x6b\157\x70\137\x70\145\x73\145\x72\164\x61");
 }
 private function getKopDocument($_0x56ff, $_0xb630 = '')
 {
 goto L_d511e;
 L_8ca27:
 return $_0x9c7b;
 L_d511e:
 $this->checkKopTables();
 goto L_71bb3;
 L_7f80b:
 $_0xd1eb = $this->dashboardModel->getSetting();
 goto L_114a0;
 L_4a5be:
 if (!$_0x9c7b) {
 $_0x9c7b = (object) ["\x69\144\x5f\153\x6f\160" => 123456, "\x68\145\x61\144\x65\162\x5f\61" => '', "\x68\145\x61\144\x65\162\x5f\62" => '', "\x68\145\x61\144\x65\162\x5f\63" => $_0xb630, "\x68\145\x61\144\x65\162\x5f\64" => '', "\x68\145\x61\144\x65\162\x5f\153\x6f\160" => '', "\x6b\157\x70\137\x6d\157\x64\145" => "\x30"];
 }
 goto L_7f80b;
 L_708b2:
 if (empty($_0x9c7b->header_1) && !empty($_0xd1eb->header_1)) {
 $_0x9c7b->header_1 = $_0xd1eb->header_1;
 }
 goto L_c6a21;
 L_c6a21:
 if (empty($_0x9c7b->header_2) && !empty($_0xd1eb->header_2)) {
 $_0x9c7b->header_2 = $_0xd1eb->header_2;
 }
 goto L_42ac3;
 L_71bb3:
 $_0xea66 = \Config\Database::connect();
 goto L_fe6be;
 L_114a0:
 if ($_0xd1eb) {
 $_0x9c7b->sekolah = $_0x9c7b->sekolah ?? $_0xd1eb->sekolah ?? '';
 $_0x9c7b->logo_kanan = $_0x9c7b->logo_kanan ?? $_0xd1eb->logo_kanan ?? '';
 $_0x9c7b->logo_kiri = $_0x9c7b->logo_kiri ?? $_0xd1eb->logo_kiri ?? '';
 $_0x9c7b->kepsek = $_0x9c7b->kepsek ?? $_0xd1eb->kepsek ?? '';
 $_0x9c7b->nip = $_0x9c7b->nip ?? $_0xd1eb->nip ?? '';
 $_0x9c7b->tanda_tangan = $_0x9c7b->tanda_tangan ?? $_0xd1eb->tanda_tangan ?? '';
 }
 goto L_708b2;
 L_fe6be:
 $_0x9c7b = null;
 goto L_0cddc;
 L_0cddc:
 if ($_0xea66->tableExists($_0x56ff)) {
 $_0x9c7b = $_0xea66->table($_0x56ff)->where("\x69\144\x5f\153\x6f\160", 123456)->get()->getRow();
 }
 goto L_4a5be;
 L_107d7:
 if (empty($_0x9c7b->header_3)) {
 $_0x9c7b->header_3 = $_0xb630;
 }
 goto L_8ca27;
 L_42ac3:
 if (empty($_0x9c7b->header_kop)) {
 $_0x31d2 = $_0xea66->table("\x63\142\x74\137\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69")->where("\x69\144\x5f\153\x6f\160", 123456)->get()->getRow();
 if (!empty($_0x31d2->header_kop) && file_exists(FCPATH . $_0x31d2->header_kop)) {
 $_0x9c7b->header_kop = $_0x31d2->header_kop;
 if (!isset($_0x9c7b->kop_mode) || $_0x9c7b->kop_mode === null || $_0x9c7b->kop_mode === '' || $_0x9c7b->kop_mode === "\x30") {
 $_0x9c7b->kop_mode = $_0x31d2->kop_mode ?? "\x31";
 }
 }
 }
 goto L_107d7;
 }
 private function handleSaveKop($_0xb62a, $_0x9e34 = "\x6b\157\x70")
 {
 goto L_1928d;
 L_ac8cf:
 if ($_0xf287 === "\x31") {
 if (!empty($_0x6313) && file_exists(FCPATH . $_0x6313)) {
 if (strpos($_0x6313, $_0x9e34) !== false) {
 @unlink(FCPATH . $_0x6313);
 }
 }
 $_0x6313 = '';
 $_0x986d = "\x30";
 }
 goto L_c2d5a;
 L_55bab:
 $_0xfb32 = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\63");
 goto L_a8d94;
 L_105b3:
 $_0xb155 = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\62");
 goto L_55bab;
 L_46558:
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => (bool) $_0x1d73, "\x68\145\x61\144\x65\162\x5f\153\x6f\160" => $_0x6313, "\x6b\157\x70\137\x6d\157\x64\145" => $_0x986d, "\x73\162\x63" => !empty($_0x6313) ? base_url($_0x6313) : '']);
 L_c81cf:
 if ($_0x9250 && $_0x9250->isValid() && !$_0x9250->hasMoved()) {
 $_0xee42 = $_0x9250->guessExtension() ?: "\x70\156\x67";
 $_0x8c33 = $_0x9e34 . "\x5f" . time() . "\x2e" . $_0xee42;
 $_0x27bb = FCPATH . "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f";
 if (!is_dir($_0x27bb)) {
 @mkdir($_0x27bb, 0777, true);
 }
 $_0x96ba = $_0x27bb . $_0x8c33;
 $_0x9250->move($_0x27bb, $_0x8c33, true);
 $this->autoCropKopImage($_0x96ba);
 $_0x6313 = "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f" . $_0x8c33;
 $_0x986d = "\x31";
 }
 goto L_c305e;
 L_fda8b:
 $_0x6313 = $_0xfc8c->header_kop ?? '';
 goto L_ac8cf;
 L_d5603:
 $_0x986d = $this->request->getPost("\x6b\157\x70\137\x6d\157\x64\145") ?? "\x30";
 goto L_d3be4;
 L_a8d94:
 $_0xce6d = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\64");
 goto L_d5603;
 L_cfa07:
 $_0xfc8c = $_0x907b->table($_0xb62a)->where("\x69\144\x5f\153\x6f\160", 123456)->get()->getRow();
 goto L_fda8b;
 L_873b5:
 $_0xefee = $this->request->getPost("\x68\145\x61\144\x65\162\x5f\61");
 goto L_105b3;
 L_c305e:
 $_0x9783 = ["\x69\144\x5f\153\x6f\160" => 123456, "\x68\145\x61\144\x65\162\x5f\61" => $_0xefee, "\x68\145\x61\144\x65\162\x5f\62" => $_0xb155, "\x68\145\x61\144\x65\162\x5f\63" => $_0xfb32, "\x68\145\x61\144\x65\162\x5f\64" => $_0xce6d, "\x68\145\x61\144\x65\162\x5f\153\x6f\160" => $_0x6313, "\x6b\157\x70\137\x6d\157\x64\145" => $_0x986d];
 goto L_dfe67;
 L_23561:
 $_0x907b = \Config\Database::connect();
 goto L_873b5;
 L_d3be4:
 $_0xf287 = $this->request->getPost("\x68\141\x70\165\x73\137\x6b\157\x70");
 goto L_cfa07;
 L_c2d5a:
 $_0x9250 = $this->request->getFile("\x68\145\x61\144\x65\162\x5f\153\x6f\160\x5f\146\x69\154\x65");
 goto L_c81cf;
 L_0131c:
 $_0x1d73 = $_0x907b->table($_0xb62a)->replace($_0x9783);
 goto L_46558;
 L_dfe67:
 if ($_0xb62a === "\x63\142\x74\137\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69") {
 $_0x9783["\x70\162\x6f\153\x74\157\x72"] = $this->request->getPost("\x70\162\x6f\153\x74\157\x72");
 $_0x9783["\x70\145\x6e\147\x61\167\x61\163\x5f\61"] = $this->request->getPost("\x70\145\x6e\147\x61\167\x61\163\x5f\61");
 $_0x9783["\x70\145\x6e\147\x61\167\x61\163\x5f\62"] = $this->request->getPost("\x70\145\x6e\147\x61\167\x61\163\x5f\62");
 }
 goto L_0131c;
 L_1928d:
 $this->checkKopTables();
 goto L_23561;
 }
 public function saveKop()
 {
 return $this->handleSaveKop("\x63\142\x74\137\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69", "\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69");
 }
 public function saveKopBerita()
 {
 return $this->handleSaveKop("\x63\142\x74\137\x6b\157\x70\137\x62\145\x72\151\x74\141", "\x6b\157\x70\137\x62\145\x72\151\x74\141");
 }
 public function saveKopPengawas()
 {
 return $this->handleSaveKop("\x63\142\x74\137\x6b\157\x70\137\x70\145\x6e\147\x61\167\x61\163", "\x6b\157\x70\137\x70\145\x6e\147\x61\167\x61\163");
 }
 public function saveKopPeserta()
 {
 return $this->handleSaveKop("\x63\142\x74\137\x6b\157\x70\137\x70\145\x73\145\x72\164\x61", "\x6b\157\x70\137\x70\145\x73\145\x72\164\x61");
 }
 public function absenPeserta()
 {
 goto L_21f85;
 L_202db:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x61\142\x73\145\x6e", $_0xe084);
 L_820ba:
 $_0xe084 = ["\x75\163\x65\162" => $_0xdfa1, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x44\141\x66\164\x61\162\x20\113\x65\150\x61\144\x69\162\x61\156", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xf73c, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x85ba, "\x6a\141\x64\167\x61\154" => $this->dropdownModel->getAllJadwal($_0xf73c->id_tp, $_0x85ba->id_smt), "\x6d\141\x70\145\x6c" => $this->dropdownModel->getAllJadwalMapel($_0xf73c->id_tp, $_0x85ba->id_smt), "\x6d\141\x70\145\x6c\137\x6a\141\x64\167\x61\154" => $this->dropdownModel->getAllMapelJadwal($_0xf73c->id_tp, $_0x85ba->id_smt), "\x6b\145\x6c\141\x73" => $this->dropdownModel->getAllKelas($_0xf73c->id_tp, $_0x85ba->id_smt), "\x72\165\x61\156\x67" => $this->dropdownModel->getAllRuang(), "\x73\145\x73\151" => $this->dropdownModel->getAllSesi(), "\x6b\157\x70" => $this->cbtModel->getSettingKopAbsensi(), "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_61e3b;
 L_e88e3:
 $_0x85ba = $this->dashboardModel->getSemesterActive();
 goto L_820ba;
 L_42df1:
 $this->checkKopTables();
 goto L_815ed;
 L_815ed:
 $_0xdfa1 = $this->getUserInfo();
 goto L_e8c8e;
 L_e8c8e:
 $_0xf73c = $this->dashboardModel->getTahunActive();
 goto L_e88e3;
 L_21f85:
 if ($_0xab9d = $this->checkAccess()) {
 return $_0xab9d;
 }
 goto L_42df1;
 L_61e3b:
 if (!$this->isAdmin()) {
 $_0xe084["\x67\165\x72\165"] = $this->dashboardModel->getDataGuruByUserId($_0xdfa1->id, $_0xf73c->id_tp, $_0x85ba->id_smt);
 }
 goto L_202db;
 }
 public function getJadwalMapel()
 {
 goto L_0587d;
 L_4c34d:
 $_0xe739 = [];
 goto L_9c909;
 L_cbd3b:
 $_0xb807 = [];
 goto L_5f495;
 L_69e1f:
 $_0xbd4a = $this->cbtModel->getRuangSesi($_0xd5a7->id_tp, $_0x6cd9->id_smt);
 goto L_026e4;
 L_b7fb5:
 $_0xf513 = $_0xb2e0->table("\x63\142\x74\137\x73\145\x73\151")->get()->getResult();
 goto L_024b9;
 L_1cdec:
 $_0x9e19 = [];
 goto L_6f3d3;
 L_a4f19:
 $_0x6cd9 = $this->dashboardModel->getSemesterActive();
 goto L_d7501;
 L_0f7fe:
 return $this->response->setJSON($_0x4cd6);
 L_1b204:
 $_0xd216 = [];
 goto L_6fe7f;
 L_6fe7f:
 foreach ($_0x4d1b as $_0xc28c) {
 $_0xa771 = array_filter(explode("\x2c", $_0xc28c->id_guru ?? ''));
 $_0x629b = !empty($_0xa771) ? $this->masterModel->getGuruByArrId($_0xa771) : [];
 $_0xd216[] = ["\x69\144\x5f\160\x65\156\x67\141\x77\141\x73" => $_0xc28c->id_pengawas ?? '', "\x69\144\x5f\162\x75\141\x6e\147" => $_0xc28c->id_ruang, "\x69\144\x5f\163\x65\163\x69" => $_0xc28c->id_sesi, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xc28c->id_jadwal, "\x72\165\x61\156\x67" => $_0xc28c->id_ruang, "\x73\145\x73\151" => $_0xc28c->id_sesi, "\x6a\141\x64\167\x61\154" => $_0xc28c->id_jadwal, "\x6a\141\x6d\137\x6b\145" => $_0xc28c->jam_ke ?? "\x31", "\x69\144\x5f\147\x75\162\x75" => $_0xc28c->id_guru ?? '', "\x67\165\x72\165" => $_0x629b, "\x70\145\x6e\147\x61\167\x61\163" => $_0x629b];
 }
 goto L_e8412;
 L_b6ecf:
 $_0x4cd6 = ["\x61\154\x6c\137\x73\145\x73\151" => array_values($_0x7633), "\x61\154\x6c\137\x74\147\x6c" => $_0xb807, "\x72\165\x61\156\x67" => $_0x1741, "\x73\145\x73\151" => $_0xf513, "\x73\151\x73\167\x61" => $_0x1250, "\x72\165\x61\156\x67\137\x6b\145\x6c\141\x73" => $_0xbd4a, "\x6b\157\x70" => ["\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69" => $_0x53d2, "\x6b\157\x70\137\x62\145\x72\151\x74\141" => $_0x219f], "\x70\145\x6e\147\x61\167\x61\163" => $_0xd216, "\x61\154\x6c\137\x70\145\x6e\147\x61\167\x61\163" => $_0xd216, "\x61\154\x6c\137\x67\165\x72\165" => $this->dropdownModel->getAllGuru(), "\x6a\141\x64\167\x61\154" => $_0xa1c8];
 goto L_0f7fe;
 L_d40bc:
 $_0x1250 = $this->cbtModel->getSiswaByKelas($_0xd5a7->id_tp, $_0x6cd9->id_smt, $_0x9e19);
 goto L_e1552;
 L_d7501:
 $_0xa1c8 = $this->cbtModel->getDataJadwalByMapel($_0xd5a7->id_tp, $_0x6cd9->id_smt, $_0x7acd);
 goto L_1cdec;
 L_0587d:
 $_0x7acd = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_4f797;
 L_024b9:
 $_0x7633 = count($_0x9e19) > 0 ? $_0xf513 : [];
 goto L_cbd3b;
 L_5f495:
 if (count($_0xe739) > 0) {
 $_0xac10 = $this->cbtModel->getJadwalByTanggal($_0xe739);
 if ($_0xac10) {
 foreach ($_0xac10 as $_0x3d4c) {
 $_0xb807[$_0x3d4c->tgl_mulai][] = $_0x3d4c;
 }
 }
 }
 goto L_b6ecf;
 L_6f3d3:
 $_0xc7dc = [];
 goto L_4c34d;
 L_e1552:
 $_0xb2e0 = \Config\Database::connect();
 goto L_d0fd5;
 L_e8412:
 $_0x53d2 = $this->cbtModel->getSettingKopAbsensi();
 goto L_0efd0;
 L_0efd0:
 $_0x219f = $this->cbtModel->getSettingKopBeritaAcara();
 goto L_d40bc;
 L_d0fd5:
 $_0x1741 = $_0xb2e0->table("\x63\142\x74\137\x72\165\x61\156\x67")->get()->getResult();
 goto L_b7fb5;
 L_4f797:
 $_0xd5a7 = $this->dashboardModel->getTahunActive();
 goto L_a4f19;
 L_9c909:
 foreach ($_0xa1c8 as $_0x4e04) {
 $_0xc7dc[] = $_0x4e04->id_jadwal;
 $_0xe739[] = $_0x4e04->tgl_mulai;
 $_0x4e04->bank_kelas = $this->maybe_unserialize($_0x4e04->bank_kelas ?? []);
 if (is_array($_0x4e04->bank_kelas)) {
 foreach ($_0x4e04->bank_kelas as $_0x60c9) {
 $_0x75d7 = is_object($_0x60c9) ? $_0x60c9->kelas_id ?? null : (is_array($_0x60c9) ? $_0x60c9["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x60c9);
 if ($_0x75d7 && !in_array($_0x75d7, $_0x9e19)) {
 $_0x9e19[] = $_0x75d7;
 }
 }
 }
 }
 goto L_69e1f;
 L_026e4:
 $_0x4d1b = $this->cbtModel->getPengawasByJadwal($_0xd5a7->id_tp, $_0x6cd9->id_smt, $_0xc7dc);
 goto L_1b204;
 }
 public function getAllJadwal()
 {
 goto L_d9fca;
 L_4154b:
 return $this->response->setJSON($_0x7a4b);
 L_eb53b:
 $_0x8dd8 = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_cf3fb;
 L_6cde7:
 $_0x1eb6 = [];
 goto L_f8b7b;
 L_f8b7b:
 foreach ($_0x8a0e as $_0x2775) {
 $_0xa9c0[] = $_0x2775->id_jadwal;
 $_0xa050 = $this->maybe_unserialize($_0x2775->bank_kelas ?? []);
 if (is_array($_0xa050)) {
 $_0x2775->bank_kelas = array_map(function ($_0x5076) {
 return (string) (is_object($_0x5076) ? $_0x5076->kelas_id ?? '' : (is_array($_0x5076) ? $_0x5076["\x6b\145\x6c\141\x73\137\x69\144"] ?? '' : $_0x5076));
 }, $_0xa050);
 foreach ($_0x2775->bank_kelas as $_0x2378) {
 if ($_0x2378 !== '' && !in_array($_0x2378, $_0xa65f)) {
 $_0xa65f[] = $_0x2378;
 }
 }
 }
 $_0x1eb6[$_0x2775->tgl_mulai][] = $_0x2775;
 }
 goto L_8f89c;
 L_c1b08:
 $_0x7a4b = ["\x61\154\x6c\137\x72\165\x61\156\x67" => array_values($_0x8cba), "\x61\154\x6c\137\x70\145\x6e\147\x61\167\x61\163" => $_0xde62, "\x61\154\x6c\137\x67\165\x72\165" => $this->dropdownModel->getAllGuru(), "\x61\154\x6c\137\x74\147\x6c" => $_0x1eb6, "\x73\151\x73\167\x61" => $this->cbtModel->getRuangSiswaByKelas($_0xb6a6->id_tp, $_0xfd81->id_smt, $_0xa65f), "\x6b\157\x70" => ["\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69" => $this->cbtModel->getSettingKopAbsensi(), "\x6b\157\x70\137\x62\145\x72\151\x74\141" => $this->cbtModel->getSettingKopBeritaAcara()]];
 goto L_4154b;
 L_d8253:
 if (count($_0xde62) > 0) {
 foreach ($_0xde62 as $_0xbffb) {
 if ($_0xbffb !== null && !empty($_0xbffb->id_guru)) {
 $_0xda06 = array_filter(explode("\x2c", $_0xbffb->id_guru));
 $_0xbffb->pengawas = $this->masterModel->getGuruByArrId($_0xda06);
 }
 }
 }
 goto L_60a7d;
 L_cf3fb:
 $_0x8a0e = $this->cbtModel->getDataJadwalByMapel($_0xb6a6->id_tp, $_0xfd81->id_smt, $_0x8dd8);
 goto L_e174b;
 L_08ab2:
 $_0xfd81 = $this->dashboardModel->getSemesterActive();
 goto L_eb53b;
 L_e174b:
 $_0xa65f = [];
 goto L_13e8b;
 L_60a7d:
 $_0x8cba = $this->cbtModel->getDistinctSesi($_0xb6a6->id_tp, $_0xfd81->id_smt, $_0xa65f);
 goto L_c1b08;
 L_13e8b:
 $_0xa9c0 = [];
 goto L_6cde7;
 L_d9fca:
 $_0xb6a6 = $this->dashboardModel->getTahunActive();
 goto L_08ab2;
 L_8f89c:
 $_0xde62 = $this->cbtModel->getPengawasByJadwal($_0xb6a6->id_tp, $_0xfd81->id_smt, $_0xa9c0);
 goto L_d8253;
 }
 public function beritaAcara()
 {
 goto L_cadc0;
 L_b7e1c:
 $_0xf776 = $_0x28c2->tahun ?? "\x32\60\x32\66\x2f\62\x30\62\x37";
 goto L_e1842;
 L_2137b:
 if (!$this->isAdmin()) {
 $_0xafc5["\x67\165\x72\165"] = $this->dashboardModel->getDataGuruByUserId($_0x90e0->id, $_0x28c2->id_tp, $_0x980a->id_smt);
 }
 goto L_eeecc;
 L_e1842:
 $_0xec09 = strtoupper($_0x980a->smt ?? "\x47\101\x4e\112\x49\114");
 goto L_e4c89;
 L_37937:
 $_0x28c2 = $this->dashboardModel->getTahunActive();
 goto L_4be02;
 L_e4c89:
 $_0xe6cf = "BERITA ACARA PELAKSANAAN\nASESMEN SUMATIF TENGAH SEMESTER {$_0xec09}\nTAHUN AJARAN {$_0xf776}";
 goto L_20ea0;
 L_cadc0:
 $_0x90e0 = $this->getUserInfo();
 goto L_37937;
 L_eeecc:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x62\145\x72\151\x74\141\x61\143\x61\162\x61", $_0xafc5);
 L_4be02:
 $_0x980a = $this->dashboardModel->getSemesterActive();
 goto L_b7e1c;
 L_20ea0:
 $_0xfaba = $this->getKopDocument("\x63\142\x74\137\x6b\157\x70\137\x62\145\x72\151\x74\141", $_0xe6cf);
 goto L_dbd53;
 L_dbd53:
 $_0xafc5 = ["\x75\163\x65\162" => $_0x90e0, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x42\145\x72\151\x74\141\x20\101\x63\141\x72\141", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x28c2, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x980a, "\x6a\141\x64\167\x61\154" => $this->dropdownModel->getAllJadwal($_0x28c2->id_tp, $_0x980a->id_smt), "\x6d\141\x70\145\x6c" => $this->dropdownModel->getAllJadwalMapel($_0x28c2->id_tp, $_0x980a->id_smt), "\x6d\141\x70\145\x6c\137\x6a\141\x64\167\x61\154" => $this->dropdownModel->getAllMapelJadwal($_0x28c2->id_tp, $_0x980a->id_smt), "\x6b\145\x6c\141\x73" => $this->dropdownModel->getAllKelas($_0x28c2->id_tp, $_0x980a->id_smt), "\x72\165\x61\156\x67" => $this->dropdownModel->getAllRuang(), "\x73\145\x73\151" => $this->dropdownModel->getAllSesi(), "\x6b\157\x70" => $_0xfaba, "\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69" => $this->cbtModel->getSettingKopAbsensi(), "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_2137b;
 }
 public function pesertaUjian($_0x895b = null)
 {
 goto L_6e3cc;
 L_4c494:
 $_0x996a = $_0xa8d0->tahun ?? "\x32\60\x32\66\x2f\62\x30\62\x37";
 goto L_fb01b;
 L_d9b0b:
 $_0x6e43 = $this->getUserInfo();
 goto L_87a1a;
 L_ad1a3:
 $_0x8ad0 = $this->getKopDocument("\x63\142\x74\137\x6b\157\x70\137\x70\145\x73\145\x72\164\x61", $_0x9f13);
 goto L_9cb31;
 L_699b2:
 if (!$this->isAdmin()) {
 $_0x5166["\x67\165\x72\165"] = $this->dashboardModel->getDataGuruByUserId($_0x6e43->id, $_0xa8d0->id_tp, $_0x7f55->id_smt);
 }
 goto L_f97e7;
 L_c2270:
 $_0x9f13 = "DAFTAR PESERTA UJIAN\nASESMEN SUMATIF TENGAH SEMESTER {$_0x1c96}\nTAHUN AJARAN {$_0x996a}";
 goto L_ad1a3;
 L_9cb31:
 $_0x5166 = ["\x75\163\x65\162" => $_0x6e43, "\x6a\165\x64\165\x6c" => "\x43\145\x74\141\x6b\40\x44\141\x66\164\x61\162\x20\120\x65\163\x65\162\x74\141", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b", "\x70\162\x6f\146\x69\154\x65" => null, "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0xa8d0, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x7f55, "\x6b\145\x6c\141\x73\163" => $this->dropdownModel->getAllKelas($_0xa8d0->id_tp, $_0x7f55->id_smt), "\x72\165\x61\156\x67\163" => $this->dropdownModel->getAllRuang(), "\x73\145\x73\151\x73" => $this->cbtModel->getAllKodeSesi(), "\x6b\157\x70" => $_0x8ad0, "\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69" => $this->cbtModel->getSettingKopAbsensi(), "\x75\152\x69\141\x6e" => $this->dropdownModel->getAllJenisUjian(), "\x6d\157\x64\145" => $_0x895b, "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_5a62b;
 L_5a62b:
 if ($_0x895b === "\x31" || $_0x895b === null) {
 $_0x5166["\x73\151\x73\167\x61"] = $this->cbtModel->getAllPesertaByRuang($_0xa8d0->id_tp, $_0x7f55->id_smt);
 } else {
 $_0x5166["\x73\151\x73\167\x61"] = $this->cbtModel->getAllPesertaByKelas($_0xa8d0->id_tp, $_0x7f55->id_smt);
 }
 goto L_699b2;
 L_fb01b:
 $_0x1c96 = strtoupper($_0x7f55->smt ?? "\x47\101\x4e\112\x49\114");
 goto L_c2270;
 L_c6cab:
 $_0x7f55 = $this->dashboardModel->getSemesterActive();
 goto L_4c494;
 L_f97e7:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x70\145\x73\145\x72\164\x61\165\x6a\151\x61\156", $_0x5166);
 L_87a1a:
 $_0xa8d0 = $this->dashboardModel->getTahunActive();
 goto L_c6cab;
 L_6e3cc:
 if ($_0x695f = $this->checkAccess()) {
 return $_0x695f;
 }
 goto L_d9b0b;
 }
 public function pengawas()
 {
 goto L_861c0;
 L_07242:
 $_0x9227 = count($_0x2eb9) > 0 ? $this->cbtModel->getAllJenisUjianByArrJenis($_0x2eb9) : ['' => "\x62\145\x6c\165\x6d\40\x61\144\x61\40\x6a\141\x64\167\x61\154\x20\165\x6a\151\x61\156"];
 goto L_264a1;
 L_694ab:
 $_0xd6db = $this->request->getGet("\x64\141\x72\151");
 goto L_f1633;
 L_79767:
 foreach ($_0xc2a4 as $_0x95b6) {
 $_0x6b4f = $this->maybe_unserialize($_0x95b6->bank_kelas ?? []);
 $_0x95b6->bank_kelas = array_map(function ($_0x7567) {
 return (string) (is_object($_0x7567) ? $_0x7567->kelas_id ?? '' : (is_array($_0x7567) ? $_0x7567["\x6b\145\x6c\141\x73\137\x69\144"] ?? '' : $_0x7567));
 }, (array) $_0x6b4f);
 foreach ($_0x95b6->bank_kelas as $_0x11a9) {
 if ($_0x11a9 !== '' && !in_array($_0x11a9, $_0x835a)) {
 $_0x835a[] = $_0x11a9;
 }
 }
 }
 goto L_26cc5;
 L_fc675:
 $_0xe4a2 = $this->cbtModel->getJenisById($_0x5a46);
 goto L_cd896;
 L_d23de:
 $_0x7e97 = $_0x3653->tahun ?? "\x32\60\x32\66\x2f\62\x30\62\x37";
 goto L_35f40;
 L_f4c1c:
 if (!empty($_0x5a46)) {
 $_0xc2a4 = $this->cbtModel->getJadwalByJenis($_0x3653->id_tp, $_0x8f2d->id_smt, $_0x5a46, $_0xd6db, $_0x9dce);
 }
 goto L_92d51;
 L_740c2:
 if (count($_0xed3b) > 0) {
 foreach ($_0xed3b as $_0x1a09) {
 $_0x2eb9[] = $_0x1a09->id_jenis;
 }
 }
 goto L_07242;
 L_ba987:
 $_0x59b3 = $this->getKopDocument("\x63\142\x74\137\x6b\157\x70\137\x70\145\x6e\147\x61\167\x61\163", $_0xabc8);
 goto L_ff5d0;
 L_6703c:
 $_0xabc8 = "JADWAL PENGAWAS RUANG\nASESMEN SUMATIF TENGAH SEMESTER {$_0x4f00}\nTAHUN AJARAN {$_0x7e97}";
 goto L_ba987;
 L_ee48f:
 $_0xc2a4 = [];
 goto L_f4c1c;
 L_2c875:
 $_0x5a46 = $this->request->getGet("\x6a\145\x6e\151\x73");
 goto L_fc675;
 L_3a6f2:
 $_0x8f2d = $this->dashboardModel->getSemesterActive();
 goto L_d3448;
 L_cd896:
 $_0x3653 = $this->dashboardModel->getTahunActive();
 goto L_3a6f2;
 L_9a297:
 if (!$this->isAdmin()) {
 $_0xfcb4["\x67\165\x72\165"] = $this->dashboardModel->getDataGuruByUserId($_0xcd4a->id, $_0x3653->id_tp, $_0x8f2d->id_smt);
 }
 goto L_c1084;
 L_861c0:
 if ($_0x3da4 = $this->checkAccess()) {
 return $_0x3da4;
 }
 goto L_6e87a;
 L_92d51:
 $_0x835a = [];
 goto L_79767;
 L_264a1:
 $_0xf3b5 = $this->request->getGet("\x66\151\x6c\164\x65\162");
 goto L_694ab;
 L_f1633:
 $_0x9dce = $this->request->getGet("\x73\141\x6d\160\x61\151");
 goto L_ee48f;
 L_9a831:
 $_0x285f = [];
 goto L_2983d;
 L_e0a76:
 $_0xfadb = $this->dashboardModel->getSetting();
 goto L_2c875;
 L_52b83:
 $_0x2eb9 = [];
 goto L_740c2;
 L_35f40:
 $_0x4f00 = strtoupper($_0x8f2d->smt ?? "\x47\101\x4e\112\x49\114");
 goto L_6703c;
 L_26cc5:
 $_0xf3a2 = !empty($_0x5a46) ? $this->cbtModel->getAllPengawas($_0x3653->id_tp, $_0x8f2d->id_smt) : [];
 goto L_9a831;
 L_d3448:
 $_0xed3b = $this->cbtModel->getDistinctJenisJadwal($_0x3653->id_tp, $_0x8f2d->id_smt);
 goto L_52b83;
 L_ff5d0:
 $_0xfcb4 = ["\x75\163\x65\162" => $_0xcd4a, "\x6a\165\x64\165\x6c" => "\x4a\141\x64\167\x61\154\x20\120\x65\156\x67\141\x77\141\x73", "\x73\165\x62\152\x75\144\x75\154" => "\x43\145\x74\141\x6b\40\x4a\141\x64\167\x61\154\x20\120\x65\156\x67\141\x77\141\x73", "\x73\145\x74\164\x69\156\x67" => $_0xfadb, "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x3653, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0x8f2d, "\x6a\145\x6e\151\x73" => $_0x9227, "\x66\151\x6c\164\x65\162" => ["\x30" => "\x53\145\x6d\165\x61", "\x31" => "\x54\141\x6e\147\x67\141\x6c"], "\x6a\145\x6e\151\x73\137\x73\145\x6c\145\x63\164\x65\144" => $_0x5a46, "\x6a\145\x6e\151\x73\137\x75\152\x69\141\x6e" => $_0xe4a2, "\x66\151\x6c\164\x65\162\x5f\163\x65\154\x65\143\x74\145\x64" => $_0xf3b5, "\x64\141\x72\151\x5f\163\x65\154\x65\143\x74\145\x64" => $_0xd6db, "\x73\141\x6d\160\x61\151\x5f\163\x65\154\x65\143\x74\145\x64" => $_0x9dce, "\x70\145\x6e\147\x61\167\x61\163" => $_0xf3a2, "\x67\165\x72\165\x73" => $this->dropdownModel->getAllGuru(), "\x72\165\x61\156\x67" => array_values($_0x285f), "\x6a\141\x64\167\x61\154\x73" => $_0xc2a4, "\x6b\157\x70" => $_0x59b3, "\x6b\157\x70\137\x61\142\x73\145\x6e\163\x69" => $this->cbtModel->getSettingKopAbsensi(), "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_9a297;
 L_6e87a:
 $_0xcd4a = $this->getUserInfo();
 goto L_e0a76;
 L_2983d:
 if (count($_0x835a) > 0) {
 $_0x934c = $this->cbtModel->getDistinctSesi($_0x3653->id_tp, $_0x8f2d->id_smt, $_0x835a);
 foreach ($_0x934c as $_0x77c9) {
 if (!isset($_0x285f[$_0x77c9->ruang_id])) {
 $_0x285f[$_0x77c9->ruang_id] = (object) ["\x72\165\x61\156\x67\137\x69\144" => $_0x77c9->ruang_id, "\x6b\157\x64\145\x5f\162\x75\141\x6e\147" => $_0x77c9->kode_ruang, "\x6e\141\x6d\141\x5f\162\x75\141\x6e\147" => $_0x77c9->nama_ruang, "\x73\145\x73\151" => []];
 }
 $_0x285f[$_0x77c9->ruang_id]->sesi[$_0x77c9->sesi_id] = (object) ["\x73\145\x73\151\x5f\151\x64" => $_0x77c9->sesi_id, "\x6b\157\x64\145\x5f\163\x65\163\x69" => $_0x77c9->kode_sesi, "\x6e\141\x6d\141\x5f\163\x65\163\x69" => $_0x77c9->nama_sesi, "\x77\141\x6b\164\x75\137\x6d\165\x6c\141\x69" => $_0x77c9->waktu_mulai, "\x77\141\x6b\164\x75\137\x61\153\x68\151\x72" => $_0x77c9->waktu_akhir, "\x69\163\x74\151\x72\141\x68\141\x74" => $_0x77c9->istirahat, "\x6b\145\x6c\141\x73\137\x69\144" => $_0x77c9->kelas_id, "\x6e\141\x6d\141\x5f\153\x65\154\x61\163" => $_0x77c9->nama_kelas, "\x70\145\x73\145\x72\164\x61" => $_0x77c9->peserta, "\x6a\141\x64\167\x61\154\x73" => []];
 $_0xf971 = is_array($_0x77c9->kelas_id) ? array_map("\x73\164\x72\166\x61\154", $_0x77c9->kelas_id) : [(string) $_0x77c9->kelas_id];
 foreach ($_0xc2a4 as $_0x95b6) {
 $_0x7c17 = false;
 foreach ($_0x95b6->bank_kelas as $_0x4974) {
 if (in_array((string) $_0x4974, $_0xf971, true)) {
 $_0x7c17 = true;
 break;
 }
 }
 if ($_0x7c17) {
 $_0x285f[$_0x77c9->ruang_id]->sesi[$_0x77c9->sesi_id]->jadwals[] = $_0x95b6;
 }
 }
 usort($_0x285f[$_0x77c9->ruang_id]->sesi[$_0x77c9->sesi_id]->jadwals, static function ($_0x461f, $_0x98b6) {
 return ($_0x461f->tgl_mulai ?? '') <=> ($_0x98b6->tgl_mulai ?? '');
 });
 }
 }
 goto L_d23de;
 L_c1084:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x70\145\x6e\147\x61\167\x61\163", $_0xfcb4);
 }
 public function getKelas()
 {
 goto L_6b8d9;
 L_3da72:
 $_0xb231 = !$_0xdd39 ? null : $_0xdd39;
 goto L_0ecae;
 L_26832:
 $_0xeab9 = $this->cbtModel->getPengawasByJadwal($_0xa78b->id_tp, $_0xf0fb->id_smt, $_0xda46);
 goto L_58d08;
 L_6b8d9:
 $_0xdd39 = $this->request->getGet("\x73\145\x73\151");
 goto L_cfdfe;
 L_41752:
 $_0xa78b = $this->dashboardModel->getTahunActive();
 goto L_0b487;
 L_58d08:
 if (count($_0xeab9) > 0) {
 foreach ($_0xeab9 as $_0xd9d1) {
 if ($_0xd9d1 !== null && !empty($_0xd9d1->id_guru)) {
 $_0xbc2c = array_filter(explode("\x2c", $_0xd9d1->id_guru));
 $_0xd9d1->pengawas = $this->masterModel->getGuruByArrId($_0xbc2c);
 }
 }
 }
 goto L_3da72;
 L_b61ce:
 $_0x9eba = $this->request->getGet("\x6b\145\x6c\141\x73");
 goto L_41752;
 L_a95c7:
 $_0xc064 = $this->cbtModel->getDataJadwalByMapel($_0xa78b->id_tp, $_0xf0fb->id_smt, $_0x5ebb);
 goto L_74457;
 L_10c44:
 $_0xc87a = $this->masterModel->getKelasById($_0x9eba);
 goto L_f7fcc;
 L_86001:
 foreach ($_0xc064 as $_0x8aa7) {
 $_0xda46[] = $_0x8aa7->id_jadwal;
 $_0x8426 = $this->maybe_unserialize($_0x8aa7->bank_kelas ?? []);
 if (is_array($_0x8426)) {
 $_0x8aa7->bank_kelas = array_map(function ($_0x9a0e) {
 return (string) (is_object($_0x9a0e) ? $_0x9a0e->kelas_id ?? '' : (is_array($_0x9a0e) ? $_0x9a0e["\x6b\145\x6c\141\x73\137\x69\144"] ?? '' : $_0x9a0e));
 }, $_0x8426);
 foreach ($_0x8aa7->bank_kelas as $_0x70ed) {
 if ($_0x70ed !== '' && !in_array($_0x70ed, $_0x6591)) {
 $_0x6591[] = $_0x70ed;
 }
 }
 }
 $_0x3ac0[$_0x8aa7->tgl_mulai][] = $_0x8aa7;
 }
 goto L_26832;
 L_cfdfe:
 $_0x5ebb = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_b61ce;
 L_5e26a:
 return $this->response->setJSON($_0x3efa);
 L_ff350:
 $_0x3efa = ["\x61\154\x6c\137\x72\165\x61\156\x67" => array_values($_0x4819), "\x61\154\x6c\137\x70\145\x6e\147\x61\167\x61\163" => $_0xeab9, "\x61\154\x6c\137\x67\165\x72\165" => $this->dropdownModel->getAllGuru(), "\x61\154\x6c\137\x74\147\x6c" => $_0x3ac0, "\x73\151\x73\167\x61" => $this->cbtModel->getRuangSiswaByKelas($_0xa78b->id_tp, $_0xf0fb->id_smt, $_0x9eba, $_0xb231), "\x69\156\x66\157" => ["\x6b\145\x6c\141\x73" => $_0xc87a, "\x73\145\x73\151" => $_0xc5b5, "\x6d\141\x70\145\x6c" => $_0x5ebb, "\x72\165\x61\156\x67" => null]];
 goto L_5e26a;
 L_f7fcc:
 $_0x4819 = $this->cbtModel->getDistinctSesi($_0xa78b->id_tp, $_0xf0fb->id_smt, $_0x6591);
 goto L_ff350;
 L_daeb0:
 $_0xda46 = [];
 goto L_61ab9;
 L_0ecae:
 $_0xc5b5 = $_0xb231 ? $this->cbtModel->getSesiById($_0xb231) : null;
 goto L_10c44;
 L_61ab9:
 $_0x3ac0 = [];
 goto L_86001;
 L_0b487:
 $_0xf0fb = $this->dashboardModel->getSemesterActive();
 goto L_a95c7;
 L_74457:
 $_0x6591 = [];
 goto L_daeb0;
 }
 public function getRuang()
 {
 goto L_1598d;
 L_fd9f9:
 $_0x10b8 = $_0x9808 === "\x6e\165\x6c\154" || !$_0x9808 ? null : $_0x9808;
 goto L_9e20a;
 L_25f40:
 $_0xe9c2 = $this->cbtModel->getRuangById($_0xb6b4);
 goto L_fd9f9;
 L_fdf37:
 $_0x1ca0 = $this->cbtModel->getPengawasByJadwal($_0x68d8->id_tp, $_0xd6cb->id_smt, $_0xc59a);
 goto L_223d6;
 L_1598d:
 $_0xb6b4 = $this->request->getGet("\x72\165\x61\156\x67");
 goto L_e5fa3;
 L_544a8:
 $_0x7fe6 = $this->request->getGet("\x6d\141\x70\145\x6c");
 goto L_ee5a8;
 L_6698d:
 $_0xc59a = [];
 goto L_a8a7d;
 L_c04c0:
 $_0x2dbd = [];
 goto L_6698d;
 L_223d6:
 if (count($_0x1ca0) > 0) {
 foreach ($_0x1ca0 as $_0x1859) {
 if ($_0x1859 !== null && !empty($_0x1859->id_guru)) {
 $_0x94c7 = array_filter(explode("\x2c", $_0x1859->id_guru));
 $_0x1859->pengawas = $this->masterModel->getGuruByArrId($_0x94c7);
 }
 }
 }
 goto L_358d1;
 L_3b07b:
 return $this->response->setJSON($_0x18ca);
 L_358d1:
 $_0x8027 = $this->cbtModel->getDistinctSesi($_0x68d8->id_tp, $_0xd6cb->id_smt, $_0x2dbd);
 goto L_25f40;
 L_a8a7d:
 $_0x85f9 = [];
 goto L_10d62;
 L_ee5a8:
 $_0x68d8 = $this->dashboardModel->getTahunActive();
 goto L_ae8bc;
 L_10d62:
 foreach ($_0xff4f as $_0xbb57) {
 $_0xc59a[] = $_0xbb57->id_jadwal;
 $_0xa216 = $this->maybe_unserialize($_0xbb57->bank_kelas ?? []);
 if (is_array($_0xa216)) {
 $_0xbb57->bank_kelas = array_map(function ($_0x5230) {
 return (string) (is_object($_0x5230) ? $_0x5230->kelas_id ?? '' : (is_array($_0x5230) ? $_0x5230["\x6b\145\x6c\141\x73\137\x69\144"] ?? '' : $_0x5230));
 }, $_0xa216);
 foreach ($_0xbb57->bank_kelas as $_0x213e) {
 if ($_0x213e !== '' && !in_array($_0x213e, $_0x2dbd)) {
 $_0x2dbd[] = $_0x213e;
 }
 }
 }
 $_0x85f9[$_0xbb57->tgl_mulai][] = $_0xbb57;
 }
 goto L_fdf37;
 L_9e20a:
 $_0xcabe = $_0x10b8 ? $this->cbtModel->getSesiById($_0x10b8) : null;
 goto L_6e1ee;
 L_ae8bc:
 $_0xd6cb = $this->dashboardModel->getSemesterActive();
 goto L_e5f49;
 L_e5fa3:
 $_0x9808 = $this->request->getGet("\x73\145\x73\151");
 goto L_544a8;
 L_6e1ee:
 $_0x18ca = ["\x61\154\x6c\137\x72\165\x61\156\x67" => array_values($_0x8027), "\x61\154\x6c\137\x70\145\x6e\147\x61\167\x61\163" => $_0x1ca0, "\x61\154\x6c\137\x67\165\x72\165" => $this->dropdownModel->getAllGuru(), "\x61\154\x6c\137\x74\147\x6c" => $_0x85f9, "\x73\151\x73\167\x61" => $this->cbtModel->getRuangSiswaByKelas($_0x68d8->id_tp, $_0xd6cb->id_smt, $_0x2dbd), "\x69\156\x66\157" => ["\x72\165\x61\156\x67" => $_0xe9c2, "\x73\145\x73\151" => $_0xcabe, "\x6d\141\x70\145\x6c" => $_0x7fe6, "\x6b\145\x6c\141\x73" => null]];
 goto L_3b07b;
 L_e5f49:
 $_0xff4f = $this->cbtModel->getDataJadwalByMapel($_0x68d8->id_tp, $_0xd6cb->id_smt, $_0x7fe6);
 goto L_c04c0;
 }
 /**
 * Halaman Cetak Rekap Peserta Ujian Susulan (Format Legger)
 */
 public function susulan()
 {
 goto L_9f770;
 L_989c1:
 return view("\x63\142\x74\57\x63\145\x74\141\x6b\57\x73\165\x73\165\x6c\141\x6e", $_0x6116);
 L_76b43:
 $_0xd9dc = $this->request->getGet("\x6b\145\x6c\141\x73") ?: $_0x76c1[0]->id_kelas ?? null;
 goto L_1f36f;
 L_f6f25:
 $_0x6116 = ["\x75\163\x65\162" => $_0x7273, "\x6a\165\x64\165\x6c" => "\x52\145\x6b\141\x70\40\x44\157\x6b\165\x6d\145\x6e\40\x55\152\x69\141\x6e\40\x53\165\x73\165\x6c\141\x6e", "\x73\165\x62\152\x75\144\x75\154" => "\x4c\145\x67\147\x65\162\x20\123\x69\163\x77\141\x20\102\x65\154\x75\155\x20\125\x6a\151\x61\156\x20\57\x20\123\x75\163\x75\154\x61\156", "\x73\145\x74\164\x69\156\x67" => $this->dashboardModel->getSetting(), "\x74\160" => $this->dashboardModel->getTahun(), "\x74\160\x5f\141\x63\164\x69\166\x65" => $_0x5aee, "\x73\155\x74" => $this->dashboardModel->getSemester(), "\x73\155\x74\137\x61\143\x74\151\x76\145" => $_0xe4fd, "\x6b\157\x70" => $this->cbtModel->getSettingKopAbsensi(), "\x6b\145\x6c\141\x73\114\x69\163\x74" => $_0x76c1, "\x73\145\x6c\145\x63\164\x65\144\x4b\145\x6c\141\x73\111\x64" => $_0xd9dc, "\x6b\145\x6c\141\x73\111\x6e\146\x6f" => $_0xb8c0, "\x66\151\x6c\164\x65\162\x4d\157\x64\145" => $_0x590c, "\x73\151\x73\167\x61\163" => $_0xfdde, "\x6d\141\x70\145\x6c\123\x6c\157\x74\163" => $_0x7dd0, "\x73\164\x61\164\x75\163\x55\152\x69\141\x6e" => $_0xb5e1, "\x73\165\x6d\155\x61\162\x79\123\x69\163\x77\141" => $_0xab02, "\x69\163\x5f\141\x64\155\x69\156" => $this->isAdmin()];
 goto L_989c1;
 L_b6b23:
 $_0xb5e1 = [];
 goto L_a648a;
 L_12c7d:
 $_0x7273 = $this->getUserInfo();
 goto L_b501e;
 L_bb0fe:
 $_0x7dd0 = [];
 goto L_b6b23;
 L_cfc96:
 $_0xb40d = \Config\Database::connect();
 goto L_e2c3c;
 L_a648a:
 // [id_siswa][id_jadwal] => status: 2 (selesai), 1 (sedang), 0 (belum/kosong)
 $_0xab02 = [];
 goto L_a68f3;
 L_9f770:
 if ($_0xec81 = $this->checkAccess()) {
 return $_0xec81;
 }
 goto L_12c7d;
 L_9b804:
 // Default: 'hanya_susulan' (hanya siswa yang belum ikut/lengkap)
 $_0xb8c0 = null;
 goto L_80030;
 L_05555:
 $_0xe4fd = $this->dashboardModel->getSemesterActive();
 goto L_cfc96;
 L_e2c3c:
 // 1. Ambil daftar kelas aktif
 $_0x76c1 = $_0xb40d->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\164\x70", $_0x5aee->id_tp)->where("\x69\144\x5f\163\x6d\164", $_0xe4fd->id_smt)->orderBy("\x6e\141\x6d\141\x5f\153\x65\154\x61\163", "\x41\123\x43")->get()->getResult();
 goto L_76b43;
 L_a68f3:
 // [id_siswa] => ['total_mapel' => x, 'selesai' => y, 'belum' => z, 'belum_mapel' => []]
 if ($_0xd9dc) {
 $_0xb8c0 = $_0xb40d->table("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163")->where("\x69\144\x5f\153\x65\154\x61\163", $_0xd9dc)->get()->getRow();
 // 2. Ambil jadwal ujian yang berlaku untuk kelas ini
 $_0xae00 = $_0xb40d->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\151\x64\137\x62\141\x6e\153\x2c\40\x61\56\x69\144\x5f\152\x65\156\x69\163\x2c\40\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69\54\x20\141\x2e\164\x67\154\x5f\163\x65\154\x65\163\x61\151\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\143\x2e\151\x64\137\x6d\141\x70\145\x6c\54\x20\143\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c\54\x20\143\x2e\153\x6f\144\x65\40\x61\163\x20\153\x6f\144\x65\137\x6d\141\x70\145\x6c\54\x20\144\x2e\153\x6f\144\x65\137\x6a\145\x6e\151\x73")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x63\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x64", "\x64\56\x69\144\x5f\152\x65\156\x69\163\x3d\141\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\164\x70", $_0x5aee->id_tp)->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xe4fd->id_smt)->orderBy("\x61\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x41\123\x43")->orderBy("\x63\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154", "\x41\123\x43")->get()->getResult();
 foreach ($_0xae00 as $_0x1092) {
 $_0x7ebc = $this->maybe_unserialize($_0x1092->bank_kelas ?? []);
 $_0x4d3a = false;
 if (is_array($_0x7ebc)) {
 foreach ($_0x7ebc as $_0x8627) {
 $_0x5cbc = is_object($_0x8627) ? $_0x8627->kelas_id ?? null : (is_array($_0x8627) ? $_0x8627["\x6b\145\x6c\141\x73\137\x69\144"] ?? null : $_0x8627);
 if ($_0x5cbc == $_0xd9dc) {
 $_0x4d3a = true;
 break;
 }
 }
 }
 if ($_0x4d3a) {
 $_0x7dd0[$_0x1092->id_jadwal] = $_0x1092;
 }
 }
 // 3. Ambil data siswa di kelas ini
 $_0xfdde = $this->masterModel->getDataSiswaByKelas($_0x5aee->id_tp, $_0xe4fd->id_smt, $_0xd9dc, 0, 0);
 // 4. Ambil data pengerjaan ujian siswa (cbt_siswa)
 $_0x6594 = [];
 if (!empty($_0x7dd0)) {
 $_0x6594 = $_0xb40d->table("\x63\142\x74\137\x73\151\x73\167\x61")->whereIn("\x69\144\x5f\152\x61\144\x77\141\x6c", array_keys($_0x7dd0))->get()->getResult();
 }
 $_0xebf5 = [];
 foreach ($_0x6594 as $_0x7310) {
 // key: id_siswa . '_' . id_jadwal
 $_0xebf5[$_0x7310->id_siswa . "\x5f" . $_0x7310->id_jadwal] = $_0x7310;
 }
 // 5. Analisis status masing-masing siswa per mapel
 $_0x73d7 = count($_0x7dd0);
 foreach ($_0xfdde as $_0x649e) {
 $_0x86a3 = $_0x649e->id_siswa;
 $_0xaaa1 = 0;
 $_0x2b6c = 0;
 $_0x5266 = [];
 foreach ($_0x7dd0 as $_0x7d53 => $_0x1092) {
 $_0x443d = $_0x86a3 . "\x5f" . $_0x7d53;
 if (isset($_0xebf5[$_0x443d])) {
 $_0xb33a = $_0xebf5[$_0x443d];
 if ($_0xb33a->status == "\x32") {
 $_0xb5e1[$_0x86a3][$_0x7d53] = ["\x73\164\x61\164\x75\163" => 2, "\x6c\141\x62\145\x6c" => "\x53\145\x6c\145\x73\141\x69", "\x6e\151\x6c\141\x69" => $_0xb33a->nilai];
 $_0xaaa1++;
 } else {
 $_0xb5e1[$_0x86a3][$_0x7d53] = ["\x73\164\x61\164\x75\163" => 1, "\x6c\141\x62\145\x6c" => "\x4d\145\x6e\147\x65\162\x6a\141\x6b\141\x6e", "\x6e\151\x6c\141\x69" => null];
 $_0x2b6c++;
 $_0x5266[] = $_0x1092->kode_mapel ?: $_0x1092->nama_mapel;
 }
 } else {
 // Belum mengerjakan sama sekali
 $_0xb5e1[$_0x86a3][$_0x7d53] = ["\x73\164\x61\164\x75\163" => 0, "\x6c\141\x62\145\x6c" => "\x42\145\x6c\165\x6d", "\x6e\151\x6c\141\x69" => null];
 $_0x2b6c++;
 $_0x5266[] = $_0x1092->kode_mapel ?: $_0x1092->nama_mapel;
 }
 }
 $_0xab02[$_0x86a3] = ["\x74\157\x74\141\x6c\137\x6d\141\x70\145\x6c" => $_0x73d7, "\x73\145\x6c\145\x73\141\x69" => $_0xaaa1, "\x62\145\x6c\165\x6d" => $_0x2b6c, "\x62\145\x6c\165\x6d\137\x6d\141\x70\145\x6c" => $_0x5266, "\x69\163\x5f\163\x75\163\x75\154\x61\156" => $_0x2b6c > 0];
 }
 // Jika filterMode = 'hanya_susulan', saring daftar siswa
 if ($_0x590c === "\x68\141\x6e\171\x61\137\x73\165\x73\165\x6c\141\x6e") {
 $_0xfdde = array_filter($_0xfdde, function ($_0x649e) use ($_0xab02) {
 return !empty($_0xab02[$_0x649e->id_siswa]["\x69\163\x5f\163\x75\163\x75\154\x61\156"]);
 });
 $_0xfdde = array_values($_0xfdde);
 }
 }
 goto L_f6f25;
 L_80030:
 $_0xfdde = [];
 goto L_bb0fe;
 L_b501e:
 $_0x5aee = $this->dashboardModel->getTahunActive();
 goto L_05555;
 L_1f36f:
 $_0x590c = $this->request->getGet("\x6d\157\x64\145") ?: "\x68\141\x6e\171\x61\137\x73\165\x73\165\x6c\141\x6e";
 goto L_9b804;
 }
}