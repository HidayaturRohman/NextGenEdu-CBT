<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\DropdownModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class Kartusiswa extends BaseController
{
 public function show($_0x334e)
 {
 return $this->renderCards((int) $_0x334e);
 }
 public function semua()
 {
 return $this->renderCards();
 }
 private function renderCards(?int $_0x4449 = null)
 {
 goto L_f2225;
 L_9d632:
 $_0xc80f = $_0x324d->getSetting();
 goto L_fd3b9;
 L_b8f8e:
 $_0xfe82 = $_0xfa78->id_tp ?? 0;
 goto L_c3b0f;
 L_d2c64:
 $_0xfa78 = $_0x324d->getTahunActive();
 goto L_056e4;
 L_77a00:
 $_0x9d5a = [];
 goto L_19478;
 L_fd3b9:
 $_0x17b0 = $this->resolveLogoUrl($_0xc80f);
 goto L_b8f8e;
 L_2fdc0:
 $_0x1a0e = trim((string) ($this->request->getGet("\x6b\145\x6c\141\x73") ?? ''));
 goto L_29dc6;
 L_ca10e:
 $_0xa752 = (new DropdownModel())->getAllKelas($_0xfe82, $_0x5dfe);
 goto L_59b24;
 L_a9860:
 if ($_0x4449 !== null) {
 $_0xfcfc->where("\x61\56\x69\144\x5f\163\x69\163\x77\141", $_0x4449);
 } else {
 if ($_0x6b45 !== '') {
 $_0xaa7a = array_values(array_filter(array_map("\x69\156\x74\166\x61\154", explode("\x2c", $_0x6b45))));
 if (!empty($_0xaa7a)) {
 $_0xfcfc->whereIn("\x61\56\x69\144\x5f\163\x69\163\x77\141", $_0xaa7a);
 }
 }
 if ($_0x1a0e !== '') {
 $_0xfcfc->where("\x64\56\x69\144\x5f\153\x65\154\x61\163", $_0x1a0e);
 }
 if ($_0x7c0e !== '') {
 $_0xfcfc->groupStart()->like("\x61\56\x6e\141\x6d\141", $_0x7c0e)->orLike("\x61\56\x6e\151\x73", $_0x7c0e)->orLike("\x61\56\x6e\151\x73\156", $_0x7c0e)->orLike("\x61\56\x75\163\x65\162\x6e\141\x6d\145", $_0x7c0e)->groupEnd();
 }
 }
 goto L_ceed5;
 L_fc251:
 $_0xfcfc->join("\x62\165\x6b\165\x5f\151\x6e\144\x75\153\x20\165", "\x75\56\x69\144\x5f\163\x69\163\x77\141\x3d\141\x2e\151\x64\137\x73\151\x73\167\x61", "\x6c\145\x66\164");
 goto L_c9262;
 L_ec91d:
 $_0x1f25 = $_0xfcfc->get()->getResult();
 goto L_0a072;
 L_2a943:
 $_0x2b52 = [];
 goto L_7b95b;
 L_ceed5:
 $_0xfcfc->orderBy("\x66\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163", "\x41\123\x43")->orderBy("\x61\56\x6e\141\x6d\141", "\x41\123\x43")->orderBy("\x61\56\x69\144\x5f\163\x69\163\x77\141", "\x41\123\x43");
 goto L_ec91d;
 L_19478:
 if (!empty($_0x24f5)) {
 foreach (array_chunk(array_unique($_0x24f5), 500) as $_0x9b6a) {
 $_0xbad0 = $_0x97f6->table("\x75\163\x65\162\x73")->whereIn("\x75\163\x65\162\x6e\141\x6d\145", $_0x9b6a)->get()->getResult();
 $_0xc51d = [];
 foreach ($_0xbad0 as $_0x7461) {
 $_0xce74[(string) $_0x7461->username] = $_0x7461;
 $_0xc51d[] = (int) $_0x7461->id;
 }
 if (!empty($_0xc51d)) {
 $_0x52a7 = $_0x97f6->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->whereIn("\x75\163\x65\162\x5f\151\x64", $_0xc51d)->where("\x67\162\x6f\165\x70\137\x69\144", "\x33")->get()->getResult();
 foreach ($_0x52a7 as $_0x8dc2) {
 $_0x9d5a[(int) $_0x8dc2->user_id] = true;
 }
 }
 }
 }
 goto L_2a943;
 L_b43f2:
 $_0xa299 = (string) $_0xca12->get("\x72\157\x6c\145");
 goto L_2c29a;
 L_0a072:
 if ($_0x4449 !== null && !$_0x1f25) {
 throw PageNotFoundException::forPageNotFound();
 }
 goto L_d47f1;
 L_0cce7:
 $_0xfcfc->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\146", "\x66\56\x69\144\x5f\153\x65\154\x61\163\x3d\144\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164");
 goto L_a9860;
 L_c3b0f:
 $_0x5dfe = $_0x1b19->id_smt ?? 0;
 goto L_2fdc0;
 L_73242:
 $_0x6a53 = $_0x4449 !== null || count($_0x1f25) <= 60;
 goto L_18074;
 L_8312d:
 $_0xce74 = [];
 goto L_77a00;
 L_29dc6:
 $_0xffc7 = trim((string) ($this->request->getGet("\x66\151\x6c\164\x65\162") ?? ''));
 goto L_208f2;
 L_2c29a:
 if (!in_array((string) $_0xa299, ["\x31", "\x32", "\x34"])) {
 return $this->response->setStatusCode(403)->setBody("\x4b\141\x72\164\x75\40\x6c\157\x67\151\x6e\40\x73\151\x73\167\x61\40\x68\141\x6e\171\x61\40\x64\141\x70\141\x74\40\x64\151\x61\153\x73\145\x73\40\x6f\154\x65\150\x20\141\x64\155\x69\156\x69\163\x74\162\x61\164\x6f\162\x20\141\x74\141\x75\40\x67\165\x72\165\x2e");
 }
 goto L_4cf07;
 L_cd446:
 foreach ($_0x1f25 as $_0x9a9b) {
 $_0x26f9 = trim((string) ($_0x9a9b->username ?? ''));
 if ($_0x26f9 !== '') {
 $_0x24f5[] = $_0x26f9;
 }
 }
 goto L_8312d;
 L_4cf07:
 $_0x324d = new DashboardModel();
 goto L_d2c64;
 L_208f2:
 $_0x7c0e = trim((string) ($this->request->getGet("\x73\145\x61\162\x63\150") ?? ''));
 goto L_6518d;
 L_7b95b:
 $_0x8d4f = 0;
 goto L_73242;
 L_17258:
 if (!$_0xca12->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to(base_url("\x61\165\x74\150"));
 }
 goto L_b43f2;
 L_056e4:
 $_0x1b19 = $_0x324d->getSemesterActive();
 goto L_9d632;
 L_f2225:
 $_0xca12 = session();
 goto L_17258;
 L_18074:
 foreach ($_0x1f25 as $_0xae32) {
 $_0x16f4 = $this->buildCard($_0xae32, $_0x97f6, $_0xce74, $_0x9d5a, $_0x6a53);
 if ($_0xffc7 === "\x32" && $_0x16f4["\x61\143\x74\151\x76\145"] === "\x31") {
 continue;
 }
 if ($_0x16f4["\x73\164\x61\164\x75\163"] !== '') {
 $_0x8d4f++;
 }
 $_0x2b52[] = $_0x16f4;
 }
 goto L_ca10e;
 L_757d1:
 $_0xfcfc->select("\x61\56\x69\144\x5f\163\x69\163\x77\141\x2c\40\x61\56\x6e\141\x6d\141\x2c\40\x61\56\x6e\151\x73\54\x20\141\x2e\156\x69\163\x6e\54\x20\141\x2e\152\x65\156\x69\163\x5f\153\x65\154\x61\155\x69\156\x2c\40\x61\56\x75\163\x65\162\x6e\141\x6d\145\x2c\40\x61\56\x70\141\x73\163\x77\157\x72\144\x2c\40\x61\56\x66\157\x74\157\x2c\40\x64\56\x69\144\x5f\153\x65\154\x61\163\x2c\40\x66\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x75\56\x73\164\x61\164\x75\163");
 goto L_fc251;
 L_c9262:
 $_0xfcfc->join("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x64", "\x64\56\x69\144\x5f\163\x69\163\x77\141\x3d\141\x2e\151\x64\137\x73\151\x73\167\x61\40\x41\116\x44\40\x64\56\x69\144\x5f\164\x70\75" . $_0x97f6->escape($_0xfe82) . "\x20\101\x4e\104\x20\144\x2e\151\x64\137\x73\155\x74\75" . $_0x97f6->escape($_0x5dfe), "\x6c\145\x66\164");
 goto L_0cce7;
 L_3424a:
 $_0x97f6 = \Config\Database::connect();
 goto L_2aa7b;
 L_d47f1:
 // Preload existing users & users_groups for fast bulk processing
 $_0x24f5 = [];
 goto L_cd446;
 L_6518d:
 $_0x6b45 = trim((string) ($this->request->getGet("\x69\144\x73") ?? ''));
 goto L_3424a;
 L_59b24:
 return $this->response->setHeader("\x43\141\x63\150\x65\55\x43\157\x6e\164\x72\157\x6c", "\x70\162\x69\166\x61\164\x65\54\x20\156\x6f\55\x73\164\x6f\162\x65")->setHeader("\x52\145\x66\145\x72\162\x65\162\x2d\120\x6f\154\x69\143\x79", "\x6e\157\x2d\162\x65\146\x65\162\x72\145\x72")->setBody(view("\x6d\141\x73\164\x65\162\x2f\163\x69\163\x77\141\x2f\153\x61\162\x74\165\x5f\154\x6f\147\x69\156", ["\x72\157\x77\163" => array_chunk($_0x2b52, 2), "\x62\165\x6c\153" => $_0x4449 === null, "\x74\157\x74\141\x6c" => count($_0x2b52), "\x70\145\x72\154\x75\120\x65\162\x69\153\x73\141" => $_0x8d4f, "\x73\145\x74\164\x69\156\x67" => $_0xc80f, "\x6c\157\x67\157\x55\162\x6c" => $_0x17b0, "\x6c\157\x67\151\x6e\125\x72\154" => base_url("\x61\165\x74\150"), "\x6b\145\x6c\141\x73\163" => $_0xa752, "\x73\145\x6c\145\x63\164\x65\144\x4b\145\x6c\141\x73" => $_0x1a0e, "\x73\145\x61\162\x63\150" => $_0x7c0e]));
 L_2aa7b:
 $_0xfcfc = $_0x97f6->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141\x20\141");
 goto L_757d1;
 }
 private function resolveLogoUrl(?object $_0x2b04): string
 {
 goto L_495ff;
 L_3cab3:
 $_0x1cc0 = [rtrim(FCPATH, "\x2f\134") . "\x2f", rtrim(ROOTPATH, "\x2f\134") . "\x2f\160\x75\142\x6c\151\x63\57", rtrim(ROOTPATH, "\x2f\134") . "\x2f"];
 goto L_e75bb;
 L_76294:
 $_0x5fd6 = [(string) ($_0x2b04->logo_kiri ?? ''), (string) ($_0x2b04->logo_kanan ?? '')];
 goto L_3cab3;
 L_8b40e:
 foreach ($_0x5fd6 as $_0x691c) {
 $_0xaad1 = ltrim(trim((string) preg_replace("\x2f\134\x3f\56\x2a\44\x2f", '', $_0x691c)), "\x2f");
 if ($_0xaad1 !== '' && $_0xaad1 !== "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163" && $_0xaad1 !== "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f") {
 return base_url($_0xaad1);
 }
 }
 goto L_5c806;
 L_5c806:
 return '';
 L_495ff:
 if (!$_0x2b04) {
 return '';
 }
 goto L_76294;
 L_e75bb:
 foreach ($_0x5fd6 as $_0x691c) {
 $_0xaad1 = ltrim(trim((string) preg_replace("\x2f\134\x3f\56\x2a\44\x2f", '', $_0x691c)), "\x2f");
 if ($_0xaad1 === '' || $_0xaad1 === "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163" || $_0xaad1 === "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f") {
 continue;
 }
 foreach ($_0x1cc0 as $_0xfaa7) {
 if (is_file($_0xfaa7 . $_0xaad1) && filesize($_0xfaa7 . $_0xaad1) > 0) {
 return base_url($_0xaad1);
 }
 }
 }
 goto L_8b40e;
 }
 private function buildCard(object $_0x8105, $_0x58a5, array &$_0x64ab, array &$_0x8caf, bool $_0xacb6): array
 {
 goto L_25556;
 L_cc871:
 if ($_0x1001 === '') {
 $_0x63f3 = "\x55\163\x65\162\x6e\141\x6d\145\x20\163\x69\163\x77\141\x20\142\x65\154\x75\155\x20\144\x69\151\x73\151\x20\160\x61\144\x61\40\x44\141\x74\141\x20\123\x69\163\x77\141\x2e";
 $_0x4943 = "\x30";
 } else {
 try {
 $_0x96fc = $_0x64ab[$_0x1001] ?? null;
 if ($_0x96fc) {
 $_0x56cd = [];
 if ((string) ($_0x96fc->active ?? "\x30") !== "\x31") {
 $_0x56cd["\x61\143\x74\151\x76\145"] = 1;
 }
 $_0x71c2 = (string) ($_0x96fc->password ?? '');
 if ($_0x71c2 === '' || strpos($_0x71c2, "\x24\62\x79\44") !== 0) {
 $_0x56cd["\x70\141\x73\163\x77\157\x72\144"] = password_hash($_0xdd4b, PASSWORD_BCRYPT);
 } elseif ($_0xacb6) {
 $_0x6b4f = htmlspecialchars($_0xdd4b, ENT_QUOTES, "\x55\124\x46\55\x38");
 if (!password_verify($_0x6b4f, $_0x71c2) && !password_verify($_0xdd4b, $_0x71c2)) {
 $_0x56cd["\x70\141\x73\163\x77\157\x72\144"] = password_hash($_0xdd4b, PASSWORD_BCRYPT);
 }
 }
 if (!empty($_0x56cd)) {
 $_0x58a5->table("\x75\163\x65\162\x73")->where("\x69\144", $_0x96fc->id)->update($_0x56cd);
 }
 if (empty($_0x8caf[(int) $_0x96fc->id])) {
 $_0x58a5->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x96fc->id, "\x67\162\x6f\165\x70\137\x69\144" => "\x33"]);
 $_0x8caf[(int) $_0x96fc->id] = true;
 }
 } else {
 $_0x9c5a = explode("\x20", trim((string) ($_0x8105->nama ?? "\x53\151\x73\167\x61")));
 $_0x3406 = $_0x9c5a[0] ?? "\x53\151\x73\167\x61";
 $_0x29f2 = count($_0x9c5a) > 1 ? end($_0x9c5a) : '';
 $_0x58a5->table("\x75\163\x65\162\x73")->insert(["\x75\163\x65\162\x6e\141\x6d\145" => $_0x1001, "\x70\141\x73\163\x77\157\x72\144" => password_hash($_0xdd4b, PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x3406, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0x29f2, "\x65\155\x61\151\x6c" => $_0x1001 . "\x40\143\x62\164\x2e\154\x6f\143\x61\154", "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1]);
 $_0x6aac = (int) $_0x58a5->insertID();
 if ($_0x6aac > 0) {
 $_0x58a5->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x6aac, "\x67\162\x6f\165\x70\137\x69\144" => "\x33"]);
 $_0x8caf[$_0x6aac] = true;
 }
 }
 } catch (\Throwable $_0xb768) {
 // Non-fatal: tetap tampilkan kartu beserta password
 }
 }
 goto L_15405;
 L_2322e:
 if ($_0x2b9a === '' || $_0x2b9a === "\x73\151\x73\167\x61\56\x70\156\x67" || !is_file(FCPATH . $_0x2b9a) && !is_file(ROOTPATH . "\x70\165\x62\154\x69\143\x2f" . $_0x2b9a) && !is_file(ROOTPATH . $_0x2b9a)) {
 $_0x2b9a = $_0x8d42;
 }
 goto L_d9ed9;
 L_d9ed9:
 return ["\x69\144\x5f\163\x69\163\x77\141" => $_0x8105->id_siswa, "\x6e\141\x6d\141" => $_0x8105->nama ?? '', "\x6e\151\x73" => $_0x8105->nis ?? '', "\x6e\151\x73\156" => $_0x8105->nisn ?? '', "\x6b\145\x6c\141\x73" => $_0x8105->nama_kelas ?? '', "\x66\157\x74\157\x55\162\x6c" => base_url($_0x2b9a), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x1001, "\x70\141\x73\163\x77\157\x72\144" => $_0xdd4b, "\x73\164\x61\164\x75\163" => $_0x63f3, "\x61\143\x74\151\x76\145" => $_0x4943];
 L_87c76:
 $_0x63f3 = '';
 goto L_9a066;
 L_9a066:
 $_0x4943 = "\x31";
 goto L_cc871;
 L_79c3d:
 if ($_0x1001 === '') {
 $_0x1001 = !empty($_0x8105->nis) ? trim((string) $_0x8105->nis) : (!empty($_0x8105->nisn) ? trim((string) $_0x8105->nisn) : '');
 if ($_0x1001 !== '' && !empty($_0x8105->id_siswa)) {
 $_0x58a5->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x8105->id_siswa)->update(["\x75\163\x65\162\x6e\141\x6d\145" => $_0x1001]);
 }
 }
 goto L_020fa;
 L_25556:
 $_0x1001 = trim((string) ($_0x8105->username ?? ''));
 goto L_79c3d;
 L_2e393:
 if (!is_file(FCPATH . $_0x8d42) && !is_file(ROOTPATH . "\x70\165\x62\154\x69\143\x2f" . $_0x8d42)) {
 $_0x8d42 = "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\163\x69\163\x77\141\x2e\160\x6e\147";
 }
 goto L_2322e;
 L_1efa2:
 if ($_0xdd4b === '' || strpos($_0xdd4b, "\x24\62\x79\44") === 0) {
 $_0xdd4b = $_0x1001 !== '' ? $_0x1001 : (!empty($_0x8105->nis) ? trim((string) $_0x8105->nis) : "\x31\62\x33\64\x35\66");
 if (!empty($_0x8105->id_siswa)) {
 $_0x58a5->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x8105->id_siswa)->update(["\x70\141\x73\163\x77\157\x72\144" => $_0xdd4b]);
 }
 }
 goto L_87c76;
 L_15405:
 $_0x2b9a = ltrim((string) ($_0x8105->foto ?? ''), "\x2f");
 goto L_5bb38;
 L_020fa:
 $_0xdd4b = trim((string) ($_0x8105->password ?? ''));
 goto L_1efa2;
 L_5bb38:
 $_0x8d42 = ($_0x8105->jenis_kelamin ?? '') === "\x50" ? "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\163\x69\163\x77\141\x2d\160\x2e\160\x6e\147" : "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\163\x69\163\x77\141\x2d\154\x2e\160\x6e\147";
 goto L_2e393;
 }
}