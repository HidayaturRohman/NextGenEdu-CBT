<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\DashboardModel;
use App\Models\MasterModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class Kartuguru extends BaseController
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
 goto L_a2e53;
 L_f1249:
 if (!in_array((string) $_0xa7c0->get("\x72\157\x6c\145"), ["\x31", "\x34"])) {
 return $this->response->setStatusCode(403)->setBody("\x4b\141\x72\164\x75\40\x6c\157\x67\151\x6e\40\x67\165\x72\165\x20\150\x61\156\x79\141\x20\144\x61\160\x61\164\x20\144\x69\141\x6b\163\x65\163\x20\157\x6c\145\x68\40\x61\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72\56");
 }
 goto L_f1fe0;
 L_294f8:
 $_0x7887 = [];
 goto L_c4ef0;
 L_c4ef0:
 $_0xd668 = 0;
 goto L_9d0b1;
 L_ec964:
 $_0xfa78 = $_0x4227->getTahunActive();
 goto L_15629;
 L_edb0a:
 return $this->response->setHeader("\x43\141\x63\150\x65\55\x43\157\x6e\164\x72\157\x6c", "\x70\162\x69\166\x61\164\x65\54\x20\156\x6f\55\x73\164\x6f\162\x65")->setHeader("\x52\145\x66\145\x72\162\x65\162\x2d\120\x6f\154\x69\143\x79", "\x6e\157\x2d\162\x65\146\x65\162\x72\145\x72")->setBody(view("\x6d\141\x73\164\x65\162\x2f\147\x75\162\x75\57\x6b\141\x72\164\x75\137\x6c\157\x67\151\x6e", ["\x72\157\x77\163" => array_chunk($_0x7887, 2), "\x62\165\x6c\153" => $_0x4449 === null, "\x74\157\x74\141\x6c" => count($_0x7887), "\x70\145\x72\154\x75\120\x65\162\x69\153\x73\141" => $_0xd668, "\x73\145\x74\164\x69\156\x67" => $_0xb865, "\x6c\157\x67\157\x55\162\x6c" => $_0x870f, "\x6c\157\x67\151\x6e\125\x72\154" => base_url("\x61\165\x74\150")]));
 L_9d0b1:
 foreach ($_0x63f0 as $_0xd005) {
 $_0x23af = $this->buildCard($_0xd005, $_0x70e8, $_0x72b2[$_0xd005->id_guru] ?? []);
 if ($_0x23af["\x73\164\x61\164\x75\163"] !== '') {
 $_0xd668++;
 }
 $_0x7887[] = $_0x23af;
 }
 goto L_edb0a;
 L_f1fe0:
 $_0xf69d = \Config\Database::connect()->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75");
 goto L_f973a;
 L_15629:
 $_0x4e85 = $_0x4227->getSemesterActive();
 goto L_bd13e;
 L_a7083:
 if ($_0x4449 !== null && !$_0x63f0) {
 throw PageNotFoundException::forPageNotFound();
 }
 goto L_7b91f;
 L_2b354:
 $_0x63f0 = $_0xf69d->orderBy("\x6e\141\x6d\141\x5f\147\x75\162\x75")->orderBy("\x69\144\x5f\147\x75\162\x75")->get()->getResult();
 goto L_a7083;
 L_7b91f:
 $_0x4227 = new DashboardModel();
 goto L_ec964;
 L_f973a:
 if ($_0x4449 !== null) {
 $_0xf69d->where("\x69\144\x5f\147\x75\162\x75", $_0x4449);
 }
 goto L_2b354;
 L_46282:
 $_0x870f = $this->resolveLogoUrl($_0xb865);
 goto L_b4ce3;
 L_a2e53:
 $_0xa7c0 = session();
 goto L_57508;
 L_bd13e:
 $_0xb865 = $_0x4227->getSetting();
 goto L_46282;
 L_1333d:
 if ($_0x63f0 && !empty($_0xfa78->id_tp) && !empty($_0x4e85->id_smt)) {
 $_0xe506 = $_0x4449 === null ? null : [$_0x4449];
 $_0x140a = (new MasterModel())->getGuruMapel($_0xfa78->id_tp, $_0x4e85->id_smt, $_0xe506);
 foreach ($_0x140a as $_0xb7ff) {
 foreach ((array) $this->maybe_unserialize($_0xb7ff->mapel_kelas ?? '') as $_0x75d7) {
 $_0xcb3c = trim((string) (((object) $_0x75d7)->nama_mapel ?? ''));
 if ($_0xcb3c !== '') {
 $_0x72b2[$_0xb7ff->id_guru][] = $_0xcb3c;
 }
 }
 }
 }
 goto L_e6132;
 L_b4ce3:
 $_0x72b2 = [];
 goto L_1333d;
 L_57508:
 if (!$_0xa7c0->get("\x69\163\x5f\154\x6f\147\x69\156")) {
 return redirect()->to(base_url("\x61\165\x74\150"));
 }
 goto L_f1249;
 L_e6132:
 $_0x70e8 = new AuthModel();
 goto L_294f8;
 }
 private function resolveLogoUrl(?object $_0xac7b): string
 {
 goto L_6cd7f;
 L_6cd7f:
 if (!$_0xac7b) {
 return '';
 }
 goto L_d07c7;
 L_ae222:
 foreach ($_0xa618 as $_0x90d2) {
 $_0xfbe6 = ltrim(trim((string) preg_replace("\x2f\134\x3f\56\x2a\44\x2f", '', $_0x90d2)), "\x2f");
 if ($_0xfbe6 !== '' && $_0xfbe6 !== "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163" && $_0xfbe6 !== "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f") {
 return base_url($_0xfbe6);
 }
 }
 goto L_40b72;
 L_d07c7:
 $_0xa618 = [(string) ($_0xac7b->logo_kiri ?? ''), (string) ($_0xac7b->logo_kanan ?? '')];
 goto L_81b97;
 L_20bd6:
 foreach ($_0xa618 as $_0x90d2) {
 $_0xfbe6 = ltrim(trim((string) preg_replace("\x2f\134\x3f\56\x2a\44\x2f", '', $_0x90d2)), "\x2f");
 if ($_0xfbe6 === '' || $_0xfbe6 === "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163" || $_0xfbe6 === "\x75\160\x6c\157\x61\144\x73\57\x73\145\x74\164\x69\156\x67\163\x2f") {
 continue;
 }
 foreach ($_0xebd5 as $_0x3299) {
 if (is_file($_0x3299 . $_0xfbe6) && filesize($_0x3299 . $_0xfbe6) > 0) {
 return base_url($_0xfbe6);
 }
 }
 }
 goto L_ae222;
 L_40b72:
 return '';
 L_81b97:
 $_0xebd5 = [rtrim(FCPATH, "\x2f\134") . "\x2f", rtrim(ROOTPATH, "\x2f\134") . "\x2f\160\x75\142\x6c\151\x63\57", rtrim(ROOTPATH, "\x2f\134") . "\x2f"];
 goto L_20bd6;
 }
 private function buildCard(object $_0x654c, AuthModel $_0xbb10, array $_0xfd98): array
 {
 goto L_de909;
 L_43b27:
 $_0x47a5 = '';
 goto L_dfafc;
 L_a765d:
 if ($_0x651f === '' || strpos($_0x651f, "\x24\62\x79\44") === 0) {
 $_0x651f = $_0x2f2a !== '' ? $_0x2f2a : (!empty($_0x654c->nip) ? trim((string) $_0x654c->nip) : "\x31\62\x33\64\x35\66");
 if (!empty($_0x654c->id_guru)) {
 $_0x17e4->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0x654c->id_guru)->update(["\x70\141\x73\163\x77\157\x72\144" => $_0x651f]);
 }
 }
 goto L_43b27;
 L_f0a10:
 return ["\x6e\141\x6d\141" => $_0x654c->nama_guru, "\x6c\141\x62\145\x6c\116\x69\160" => $_0x654c->jenis_nip ?? '' ?: "\x4e\111\x50", "\x6e\151\x70" => $_0x654c->nip ?? '', "\x6b\157\x64\145" => $_0x654c->kode_guru ?? '', "\x66\157\x74\157\x55\162\x6c" => base_url($_0x5180), "\x6d\141\x70\145\x6c" => implode("\x2c\40", array_unique($_0xfd98)), "\x75\163\x65\162\x6e\141\x6d\145" => $_0x2f2a, "\x70\141\x73\163\x77\157\x72\144" => $_0x651f, "\x73\164\x61\164\x75\163" => $_0x47a5];
 L_de909:
 $_0x17e4 = \Config\Database::connect();
 goto L_59e0f;
 L_1294a:
 $_0x5180 = ltrim((string) ($_0x654c->foto ?? ''), "\x2f");
 goto L_aaf88;
 L_32647:
 $_0x651f = trim((string) ($_0x654c->password ?? ''));
 goto L_a765d;
 L_dfafc:
 if ($_0x2f2a === '') {
 $_0x47a5 = "\x55\163\x65\162\x6e\141\x6d\145\x20\147\x75\162\x75\40\x62\145\x6c\165\x6d\40\x64\151\x69\163\x69\40\x70\141\x64\141\x20\104\x61\164\x61\40\x47\165\x72\165\x2e";
 } else {
 try {
 $_0xb0cc = $_0x17e4->table("\x75\163\x65\162\x73")->where("\x75\163\x65\162\x6e\141\x6d\145", $_0x2f2a)->get()->getRow();
 if (!$_0xb0cc && !empty($_0x654c->id_user)) {
 $_0x10fe = $_0x17e4->table("\x75\163\x65\162\x73")->where("\x69\144", (int) $_0x654c->id_user)->get()->getRow();
 if ($_0x10fe) {
 $_0x7bdf = $_0x17e4->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\165\x73\145\x72", (int) $_0x10fe->id)->where("\x69\144\x5f\147\x75\162\x75\40\x21\75", (int) $_0x654c->id_guru)->get()->getRow();
 if (!$_0x7bdf) {
 $_0xb0cc = $_0x10fe;
 }
 }
 }
 $_0x34a3 = htmlspecialchars($_0x651f, ENT_QUOTES, "\x55\124\x46\55\x38");
 if ($_0xb0cc) {
 $_0xe4c3 = [];
 if ((string) ($_0xb0cc->active ?? "\x30") !== "\x31") {
 $_0xe4c3["\x61\143\x74\151\x76\145"] = 1;
 }
 if ((string) ($_0xb0cc->username ?? '') !== $_0x2f2a) {
 $_0xe4c3["\x75\163\x65\162\x6e\141\x6d\145"] = $_0x2f2a;
 }
 if (!password_verify($_0x34a3, (string) ($_0xb0cc->password ?? '')) && !password_verify($_0x651f, (string) ($_0xb0cc->password ?? ''))) {
 $_0xe4c3["\x70\141\x73\163\x77\157\x72\144"] = password_hash($_0x651f, PASSWORD_BCRYPT);
 }
 if (!empty($_0xe4c3)) {
 $_0x17e4->table("\x75\163\x65\162\x73")->where("\x69\144", $_0xb0cc->id)->update($_0xe4c3);
 }
 $_0xabf2 = $_0x17e4->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->where(["\x75\163\x65\162\x5f\151\x64" => $_0xb0cc->id, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"])->get()->getRow();
 if (!$_0xabf2) {
 $_0x17e4->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0xb0cc->id, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"]);
 }
 if ((int) ($_0x654c->id_user ?? 0) !== (int) $_0xb0cc->id) {
 $_0x17e4->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0x654c->id_guru)->update(["\x69\144\x5f\165\x73\145\x72" => $_0xb0cc->id]);
 }
 } else {
 $_0x822c = explode("\x20", trim((string) ($_0x654c->nama_guru ?? "\x47\165\x72\165")));
 $_0x2a70 = $_0x822c[0] ?? "\x47\165\x72\165";
 $_0x3784 = count($_0x822c) > 1 ? end($_0x822c) : '';
 $_0x17e4->table("\x75\163\x65\162\x73")->insert(["\x75\163\x65\162\x6e\141\x6d\145" => $_0x2f2a, "\x70\141\x73\163\x77\157\x72\144" => password_hash($_0x651f, PASSWORD_BCRYPT), "\x66\151\x72\163\x74\137\x6e\141\x6d\145" => $_0x2a70, "\x6c\141\x73\164\x5f\156\x61\155\x65" => $_0x3784, "\x65\155\x61\151\x6c" => !empty($_0x654c->email) ? $_0x654c->email : $_0x2f2a . "\x40\143\x62\164\x2e\154\x6f\143\x61\154", "\x63\162\x65\141\x74\145\x64\137\x6f\156" => time(), "\x61\143\x74\151\x76\145" => 1]);
 $_0x1607 = (int) $_0x17e4->insertID();
 if ($_0x1607 > 0) {
 $_0x17e4->table("\x75\163\x65\162\x73\137\x67\162\x6f\165\x70\163")->insert(["\x75\163\x65\162\x5f\151\x64" => $_0x1607, "\x67\162\x6f\165\x70\137\x69\144" => "\x32"]);
 $_0x17e4->table("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75")->where("\x69\144\x5f\147\x75\162\x75", $_0x654c->id_guru)->update(["\x69\144\x5f\165\x73\145\x72" => $_0x1607]);
 }
 }
 } catch (\Throwable $_0xa7c5) {
 // Non-fatal: tetap tampilkan kartu beserta password
 }
 }
 goto L_1294a;
 L_59e0f:
 $_0x2f2a = trim((string) ($_0x654c->username ?? ''));
 goto L_32647;
 L_aaf88:
 if ($_0x5180 === '' || !is_file(FCPATH . $_0x5180) && !is_file(ROOTPATH . "\x70\165\x62\154\x69\143\x2f" . $_0x5180) && !is_file(ROOTPATH . $_0x5180)) {
 $_0x5180 = "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\147\x75\162\x75\56\x70\156\x67";
 }
 goto L_f0a10;
 }
}