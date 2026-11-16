<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\BannerModel;
use App\Models\CbtModel;
use App\Models\DashboardModel;
use App\Models\LogModel;
use App\Models\SettingsModel;
/**
 * REST API Native khusus Aplikasi Android Member Siswa (Bukan WebView)
 * Berjalan berdampingan (koeksistensi 100%) dengan Member Siswa versi Web.
 */
class SiswaApi extends BaseController
{
 private string $tokenSecret = "\x43\102\x54\61\x36\60\x43\111\x34\137\x4e\101\x54\111\x56\105\x5f\123\x49\123\x57\101\x5f\123\x45\103\x52\105\x54\137\x32\60\x32\66\x5f\113\x45\131";
 private function setCorsHeaders(): void
 {
 goto L_3d80c;
 L_3d603:
 $this->response->setHeader("\x41\143\x63\145\x73\163\x2d\103\x6f\156\x74\162\x6f\154\x2d\101\x6c\154\x6f\167\x2d\110\x65\141\x64\145\x72\163", "\x41\165\x74\150\x6f\162\x69\172\x61\164\x69\157\x6e\54\x20\103\x6f\156\x74\145\x6e\164\x2d\124\x79\160\x65\54\x20\130\x2d\122\x65\161\x75\145\x73\164\x65\144\x2d\127\x69\164\x68\54\x20\130\x2d\104\x65\166\x69\143\x65\55\x49\144\x2c\40\x55\163\x65\162\x2d\101\x67\145\x6e\164");
 goto L_a05ba;
 L_3d80c:
 $this->response->setHeader("\x41\143\x63\145\x73\163\x2d\103\x6f\156\x74\162\x6f\154\x2d\101\x6c\154\x6f\167\x2d\117\x72\151\x67\151\x6e", "\x2a");
 goto L_3d603;
 L_a05ba:
 $this->response->setHeader("\x41\143\x63\145\x73\163\x2d\103\x6f\156\x74\162\x6f\154\x2d\101\x6c\154\x6f\167\x2d\115\x65\164\x68\157\x64\163", "\x47\105\x54\54\x20\120\x4f\123\x54\54\x20\117\x50\124\x49\117\x4e\123");
 }
 private function jsonResponse(array $_0xc0f1, int $_0xc8ab = 200)
 {
 $this->setCorsHeaders();
 return $this->response->setStatusCode($_0xc8ab)->setJSON($_0xc0f1);
 }
 private function getJsonOrPost(): array
 {
 goto L_6a03c;
 L_6a03c:
 $_0x7227 = [];
 goto L_6b92d;
 L_cb465:
 $_0x30c3 = $this->request->getGet() ?? [];
 goto L_3ad65;
 L_3ad65:
 return array_merge($_0x30c3, $_0x9767, $_0x7227);
 L_74cff:
 $_0x9767 = $this->request->getPost() ?? [];
 goto L_cb465;
 L_6b92d:
 try {
 $_0xfc84 = $this->request->getBody();
 if (!empty($_0xfc84)) {
 $_0xe17c = json_decode($_0xfc84, true);
 if (is_array($_0xe17c)) {
 $_0x7227 = $_0xe17c;
 }
 }
 } catch (\Throwable $_0x34c3) {
 }
 goto L_74cff;
 }
 private function ensureTokenTable(): void
 {
 try {
 $_0xcb72 = \Config\Database::connect();
 if (!$_0xcb72->tableExists("\x63\142\x74\137\x61\160\x69\137\x74\157\x6b\145\x6e\163")) {
 $_0xcb72->query("\x43\122\x45\101\x54\105\x20\124\x41\102\x4c\105\x20\111\x46\40\x4e\117\x54\40\x45\130\x49\123\x54\123\x20\143\x62\164\x5f\141\x70\151\x5f\164\x6f\153\x65\156\x73\40\x28\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\144\x20\111\x4e\124\x20\101\x55\124\x4f\137\x49\116\x43\122\x45\115\x45\116\x54\40\x50\122\x49\115\x41\122\x59\40\x4b\105\x59\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\151\x64\137\x73\151\x73\167\x61\40\x49\116\x54\40\x4e\117\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x75\163\x65\162\x6e\141\x6d\145\x20\126\x41\122\x43\110\x41\122\x28\61\x30\60\x29\40\x4e\117\x54\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x74\157\x6b\145\x6e\40\x56\101\x52\103\x48\101\x52\50\x31\71\x31\51\x20\116\x4f\124\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\144\x65\166\x69\143\x65\137\x69\156\x66\157\x20\126\x41\122\x43\110\x41\122\x28\62\x35\65\x29\40\x4e\125\x4c\114\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x69\160\x5f\141\x64\144\x72\145\x73\163\x20\126\x41\122\x43\110\x41\122\x28\66\x34\51\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\143\x72\145\x61\164\x65\144\x5f\141\x74\40\x44\101\x54\105\x54\111\x4d\105\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\154\x61\163\x74\137\x75\163\x65\144\x5f\141\x74\40\x44\101\x54\105\x54\111\x4d\105\x20\116\x55\114\x4c\54\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\125\x4e\111\x51\125\x45\40\x4b\105\x59\40\x75\156\x69\161\x5f\164\x6f\153\x65\156\x20\50\x74\157\x6b\145\x6e\51\x2c\12\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x49\116\x44\105\x58\40\x69\144\x78\137\x73\151\x73\167\x61\40\x28\151\x64\137\x73\151\x73\167\x61\51\xa\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\x20\51\x20\105\x4e\107\x49\116\x45\75\x49\156\x6e\157\x44\102\x20\104\x45\106\x41\125\x4c\124\x20\103\x48\101\x52\123\x45\124\x3d\165\x74\146\x38\155\x62\64");
 }
 } catch (\Throwable $_0xd37b) {
 }
 }
 private function generateToken(int $_0xc8ca, string $_0x8415, string $_0x487f = ''): string
 {
 goto L_39874;
 L_4557b:
 return $_0xc6b3;
 L_9366c:
 $_0x8eae = hash_hmac("\x73\150\x61\62\x35\66", $_0xbf68, $this->tokenSecret);
 goto L_1ae80;
 L_39874:
 $this->ensureTokenTable();
 goto L_25ba9;
 L_1ae80:
 $_0xc6b3 = $_0xbf68 . "\x2e" . $_0x8eae;
 goto L_bbf93;
 L_bbf93:
 try {
 $_0x55b8 = \Config\Database::connect();
 $_0x55b8->table("\x63\142\x74\137\x61\160\x69\137\x74\157\x6b\145\x6e\163")->insert(["\x69\144\x5f\163\x69\163\x77\141" => $_0xc8ca, "\x75\163\x65\162\x6e\141\x6d\145" => $_0x8415, "\x74\157\x6b\145\x6e" => substr($_0x8eae, 0, 64), "\x64\145\x76\151\x63\145\x5f\151\x6e\146\x6f" => substr($_0x487f, 0, 250), "\x69\160\x5f\141\x64\144\x72\145\x73\163" => $this->request->getIPAddress(), "\x63\162\x65\141\x74\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x6c\141\x73\164\x5f\165\x73\145\x64\137\x61\164" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73")]);
 } catch (\Throwable $_0x34bc) {
 }
 goto L_4557b;
 L_25ba9:
 $_0xbf68 = base64_encode(json_encode(["\x69\144\x5f\163\x69\163\x77\141" => $_0xc8ca, "\x75\163\x65\162\x6e\141\x6d\145" => $_0x8415, "\x69\141\x74" => time(), "\x72\156\x64" => bin2hex(random_bytes(8))]));
 goto L_9366c;
 }
 /**
 * Autentikasi Bearer Token dari Header Authorization atau parameter token
 */
 private function authenticateSiswa(): ?object
 {
 goto L_329e2;
 L_27bb9:
 if ($_0x5161 === '') {
 $_0x51fa = $this->getJsonOrPost();
 $_0x5161 = trim((string) ($_0x51fa["\x74\157\x6b\145\x6e\137\x61\165\x74\150"] ?? $_0x51fa["\x61\160\x69\137\x74\157\x6b\145\x6e"] ?? ''));
 }
 goto L_89af8;
 L_1303b:
 if (preg_match("\x2f\102\x65\141\x72\145\x72\134\x73\53\x28\56\x2b\51\x24\57\x69", $_0x937b, $_0x97ef)) {
 $_0x5161 = trim($_0x97ef[1]);
 }
 goto L_27bb9;
 L_30f88:
 $_0x5e4a = $_0xeff4->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->where("\x69\144\x5f\163\x69\163\x77\141", (int) $_0x5d17["\x69\144\x5f\163\x69\163\x77\141"])->get()->getRow();
 goto L_b9946;
 L_89af8:
 if ($_0x5161 === '' || !str_contains($_0x5161, "\x2e")) {
 return null;
 }
 goto L_6a81a;
 L_ae967:
 if (!hash_equals($_0x287c, $_0x4b8d)) {
 return null;
 }
 goto L_d7438;
 L_2824a:
 $_0x5161 = '';
 goto L_1303b;
 L_8c056:
 if (!is_array($_0x5d17) || empty($_0x5d17["\x69\144\x5f\163\x69\163\x77\141"])) {
 return null;
 }
 goto L_3885c;
 L_b9946:
 if (!$_0x5e4a) {
 return null;
 }
 goto L_fc006;
 L_329e2:
 $_0x937b = $this->request->getHeaderLine("\x41\165\x74\150\x6f\162\x69\172\x61\164\x69\157\x6e");
 goto L_2824a;
 L_6a81a:
 [$_0x8934, $_0x4b8d] = explode("\x2e", $_0x5161, 2);
 goto L_9b366;
 L_fc006:
 return $this->enrichSiswaProfile($_0x5e4a);
 L_9b366:
 $_0x287c = hash_hmac("\x73\150\x61\62\x35\66", $_0x8934, $this->tokenSecret);
 goto L_ae967;
 L_3885c:
 $_0xeff4 = \Config\Database::connect();
 goto L_30f88;
 L_d7438:
 $_0x5d17 = json_decode((string) base64_decode($_0x8934, true), true);
 goto L_8c056;
 }
 /**
 * Lengkapi profil siswa dengan kelas, ruang, sesi, nomor peserta, dan URL foto penuh
 */
 private function enrichSiswaProfile(object $_0xbe9f): object
 {
 goto L_0f66d;
 L_446b0:
 $_0x9701 = $_0xb488->waktu_mulai ?? null;
 goto L_e0151;
 L_cfc6c:
 $_0xbe9f->id_kelas = $_0x931f->id_kelas ?? $_0xbe9f->kelas_awal ?? 0;
 goto L_aaf37;
 L_f25b0:
 $_0xbe9f->nama_jurusan = $_0x931f->nama_jurusan ?? '';
 goto L_10e5e;
 L_c0334:
 $_0xbe9f->nama_sesi = $_0xf69b ?: "\x53\145\x73\151\x20\61";
 goto L_aaf46;
 L_61246:
 if (empty($_0x88ab)) {
 $_0x84cc = $_0xfe87->table("\x63\142\x74\137\x73\145\x73\151")->orderBy("\x69\144\x5f\163\x65\163\x69", "\x41\123\x43")->get()->getRow();
 $_0x88ab = $_0x84cc->id_sesi ?? 1;
 $_0xf69b = $_0x84cc->nama_sesi ?? "\x53\145\x73\151\x20\61";
 $_0x4f73 = $_0x84cc->kode_sesi ?? "\x53\61";
 $_0x9701 = $_0x84cc->waktu_mulai ?? "\x30\66\x3a\60\x30\72\x30\60";
 $_0xbb64 = $_0x84cc->waktu_akhir ?? "\x32\63\x3a\65\x39\72\x30\60";
 }
 goto L_50d9f;
 L_aaf46:
 $_0xbe9f->kode_sesi = $_0x4f73 ?: "\x53\61";
 goto L_7175d;
 L_9793c:
 $_0x6701 = $_0x7505->id_smt ?? 1;
 goto L_87a8b;
 L_37b08:
 $_0x26bc = new DashboardModel();
 goto L_c99a0;
 L_f172f:
 $_0xe2da = $_0xb552->id_tp ?? 1;
 goto L_9793c;
 L_f58e7:
 if (!$_0xb488) {
 $_0xb488 = $_0xfe87->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x73\151\x73\167\x61\137\x69\144", $_0x2cb4)->orderBy("\x61\56\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 }
 goto L_7c404;
 L_e0151:
 $_0xbb64 = $_0xb488->waktu_akhir ?? null;
 goto L_61246;
 L_04b0e:
 $_0x7505 = $_0x26bc->getSemesterActive();
 goto L_f172f;
 L_81c81:
 $_0xbe9f->nama_ruang = $_0x539b ?: "\x52\165\x61\156\x67\40\x31";
 goto L_67f35;
 L_b5b52:
 $_0x539b = $_0xb488->nama_ruang ?? null;
 goto L_aa89a;
 L_3e99e:
 $_0xa209 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_b2f35;
 L_b2f35:
 $_0x549c = $_0xa209 . "\x61\163\x73\145\x74\163\x2f\151\x6d\147\x2f\163\x69\163\x77\141\x2e\160\x6e\147";
 goto L_59527;
 L_e5126:
 $_0xbe9f->tahun_pelajaran = $_0xb552->tahun ?? '';
 goto L_ef6b6;
 L_1dd97:
 $_0x4f73 = $_0xb488->kode_sesi ?? null;
 goto L_446b0;
 L_10e5e:
 $_0xbe9f->ruang_id = $_0xfceb;
 goto L_81c81;
 L_7175d:
 $_0xbe9f->waktu_mulai = $_0x9701 ?: "\x30\66\x3a\60\x30\72\x30\60";
 goto L_1ca8b;
 L_75af3:
 // Sesi & Ruang CBT
 $_0xb488 = $_0xfe87->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where(["\x61\56\x73\151\x73\167\x61\137\x69\144" => $_0x2cb4, "\x61\56\x74\160\x5f\151\x64" => $_0xe2da, "\x61\56\x73\155\x74\137\x69\144" => $_0x6701])->get()->getRow();
 goto L_f58e7;
 L_0f1e9:
 if (empty($_0xfceb)) {
 $_0x1c26 = $_0xfe87->table("\x63\142\x74\137\x72\165\x61\156\x67")->orderBy("\x69\144\x5f\162\x75\141\x6e\147", "\x41\123\x43")->get()->getRow();
 $_0xfceb = $_0x1c26->id_ruang ?? 1;
 $_0x539b = $_0x1c26->nama_ruang ?? "\x52\165\x61\156\x67\40\x31";
 $_0x4606 = $_0x1c26->kode_ruang ?? "\x52\61";
 }
 goto L_eb8b9;
 L_7c404:
 if (!$_0xb488 && !empty($_0x931f->id_kelas)) {
 $_0xb488 = $_0xfe87->table("\x63\142\x74\137\x73\145\x73\151\x5f\163\x69\163\x77\141\x20\141")->select("\x61\56\x72\165\x61\156\x67\137\x69\144\x2c\40\x61\56\x73\145\x73\151\x5f\151\x64\54\x20\162\x2e\153\x6f\144\x65\137\x72\165\x61\156\x67\54\x20\162\x2e\156\x61\155\x61\137\x72\165\x61\156\x67\54\x20\163\x2e\153\x6f\144\x65\137\x73\145\x73\151\x2c\40\x73\56\x6e\141\x6d\141\x5f\163\x65\163\x69\54\x20\163\x2e\167\x61\153\x74\165\x5f\155\x75\154\x61\151\x2c\40\x73\56\x77\141\x6b\164\x75\137\x61\153\x68\151\x72")->join("\x63\142\x74\137\x72\165\x61\156\x67\40\x72", "\x72\56\x69\144\x5f\162\x75\141\x6e\147\x3d\141\x2e\162\x75\141\x6e\147\x5f\151\x64", "\x6c\145\x66\164")->join("\x63\142\x74\137\x73\145\x73\151\x20\163", "\x73\56\x69\144\x5f\163\x65\163\x69\75\x61\56\x73\145\x73\151\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x6b\145\x6c\141\x73\137\x69\144", $_0x931f->id_kelas)->orderBy("\x61\56\x69\144\x5f\163\x65\163\x69\137\x73\151\x73\167\x61", "\x44\105\x53\103")->get()->getRow();
 }
 goto L_39cd8;
 L_87a8b:
 $_0x2cb4 = (int) $_0xbe9f->id_siswa;
 goto L_501d1;
 L_1ca8b:
 $_0xbe9f->waktu_akhir = $_0xbb64 ?: "\x32\63\x3a\65\x39\72\x30\60";
 goto L_f546b;
 L_50d9f:
 $_0xd91d = $_0xfe87->table("\x63\142\x74\137\x6e\157\x6d\157\x72\137\x70\145\x73\145\x72\164\x61")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x2cb4)->orderBy("\x69\144\x5f\156\x6f\155\x6f\162", "\x44\105\x53\103")->get()->getRow();
 goto L_a260d;
 L_eb8b9:
 $_0x88ab = $_0xb488->sesi_id ?? null;
 goto L_7460e;
 L_61d93:
 unset($_0xbe9f->password);
 goto L_475d1;
 L_da43b:
 $_0xbe9f->sesi_id = $_0x88ab;
 goto L_c0334;
 L_21f17:
 $_0xbe9f->level_id = $_0x931f->level_id ?? '';
 goto L_f25b0;
 L_81273:
 $_0xbe9f->id_tp = $_0xe2da;
 goto L_e5126;
 L_501d1:
 // Kelas siswa di TP & SMT aktif
 $_0x931f = $_0xfe87->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6b\157\x64\145\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6c\145\x76\145\x6c\137\x69\144\x2c\40\x6a\56\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156\x2c\40\x6a\56\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x3d\141\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156\x20\152", "\x6a\56\x69\144\x5f\152\x75\162\x75\163\x61\156\x3d\153\x2e\152\x75\162\x75\163\x61\156\x5f\151\x64", "\x6c\145\x66\164")->where(["\x61\56\x69\144\x5f\163\x69\163\x77\141" => $_0x2cb4, "\x61\56\x69\144\x5f\164\x70" => $_0xe2da, "\x61\56\x69\144\x5f\163\x6d\164" => $_0x6701])->get()->getRow();
 goto L_bae80;
 L_a260d:
 $_0x1e1c = $_0xd91d->nomor_peserta ?? ($_0xbe9f->nis ?: ($_0xbe9f->nisn ?: $_0xbe9f->username ?? "\x50\105\x53\105\x52\124\x41\55" . $_0x2cb4));
 goto L_3e99e;
 L_c99a0:
 $_0xb552 = $_0x26bc->getTahunActive();
 goto L_04b0e;
 L_ef6b6:
 $_0xbe9f->id_smt = $_0x6701;
 goto L_7dabe;
 L_475d1:
 return $_0xbe9f;
 L_c33bd:
 $_0xbe9f->foto_url = $_0x549c;
 goto L_61d93;
 L_cb2de:
 $_0xbe9f->kode_kelas = $_0x931f->kode_kelas ?? "\x2d";
 goto L_21f17;
 L_aaf37:
 $_0xbe9f->nama_kelas = $_0x931f->nama_kelas ?? "\x2d";
 goto L_cb2de;
 L_39cd8:
 $_0xfceb = $_0xb488->ruang_id ?? null;
 goto L_b5b52;
 L_bae80:
 if (!$_0x931f) {
 $_0x931f = $_0xfe87->table("\x6b\145\x6c\141\x73\137\x73\151\x73\167\x61\40\x61")->select("\x61\56\x69\144\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6e\141\x6d\141\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6b\157\x64\145\x5f\153\x65\154\x61\163\x2c\40\x6b\56\x6c\145\x76\145\x6c\137\x69\144\x2c\40\x6a\56\x6e\141\x6d\141\x5f\152\x75\162\x75\163\x61\156\x2c\40\x6a\56\x6b\157\x64\145\x5f\152\x75\162\x75\163\x61\156")->join("\x6d\141\x73\164\x65\162\x5f\153\x65\154\x61\163\x20\153", "\x6b\56\x69\144\x5f\153\x65\154\x61\163\x3d\141\x2e\151\x64\137\x6b\145\x6c\141\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\152\x75\162\x75\163\x61\156\x20\152", "\x6a\56\x69\144\x5f\152\x75\162\x75\163\x61\156\x3d\153\x2e\152\x75\162\x75\163\x61\156\x5f\151\x64", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\163\x69\163\x77\141", $_0x2cb4)->orderBy("\x61\56\x69\144\x5f\153\x65\154\x61\163\x5f\163\x69\163\x77\141", "\x44\105\x53\103")->get()->getRow();
 }
 goto L_75af3;
 L_aa89a:
 $_0x4606 = $_0xb488->kode_ruang ?? null;
 goto L_0f1e9;
 L_7460e:
 $_0xf69b = $_0xb488->nama_sesi ?? null;
 goto L_1dd97;
 L_f546b:
 $_0xbe9f->nomor_peserta = $_0x1e1c;
 goto L_c33bd;
 L_59527:
 if (!empty($_0xbe9f->foto)) {
 if (filter_var($_0xbe9f->foto, FILTER_VALIDATE_URL)) {
 $_0x549c = $_0xbe9f->foto;
 } else {
 $_0x549c = $_0xa209 . ltrim($_0xbe9f->foto, "\x2f");
 }
 }
 goto L_81273;
 L_67f35:
 $_0xbe9f->kode_ruang = $_0x4606 ?: "\x52\61";
 goto L_da43b;
 L_0f66d:
 $_0xfe87 = \Config\Database::connect();
 goto L_37b08;
 L_7dabe:
 $_0xbe9f->nama_smt = $_0x7505->nama_smt ?? $_0x7505->smt ?? '';
 goto L_cfc6c;
 }
 private function getSekolahInfo(): array
 {
 goto L_f6e3e;
 L_6200e:
 $_0x2576 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_069ba;
 L_d082f:
 $_0xc38a = $_0x38ca->getSemesterActive();
 goto L_6200e;
 L_6ead8:
 $_0xe457 = $_0x38ca->getSetting();
 goto L_4e0d4;
 L_4e0d4:
 $_0xab24 = $_0x38ca->getTahunActive();
 goto L_d082f;
 L_069ba:
 $_0x4c4f = !empty($_0xe457->logo_kanan) ? $_0x2576 . ltrim($_0xe457->logo_kanan, "\x2f") : '';
 goto L_a3b7f;
 L_09529:
 return ["\x6e\141\x6d\141\x5f\163\x65\153\x6f\154\x61\150" => $_0xe457->sekolah ?? "\x43\102\x54\40\x53\145\x6b\157\x6c\141\x68", "\x6a\145\x6e\152\x61\156\x67" => $_0xe457->jenjang ?? '', "\x61\154\x61\155\x61\164" => $_0xe457->alamat ?? '', "\x6b\157\x74\141" => $_0xe457->kota ?? '', "\x6b\145\x70\163\x65\153" => $_0xe457->kepsek ?? '', "\x6c\157\x67\157\x5f\153\x61\156\x61\156" => $_0x4c4f, "\x6c\157\x67\157\x5f\153\x69\162\x69" => $_0x6174, "\x69\144\x5f\164\x70" => $_0xab24->id_tp ?? 1, "\x74\141\x68\165\x6e\137\x70\145\x6c\141\x6a\141\x72\141\x6e" => $_0xab24->tahun ?? '', "\x69\144\x5f\163\x6d\164" => $_0xc38a->id_smt ?? 1, "\x73\145\x6d\145\x73\164\x65\162" => $_0xc38a->nama_smt ?? $_0xc38a->smt ?? '', "\x73\145\x72\166\x65\162\x5f\164\x69\155\x65" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x73\145\x72\166\x65\162\x5f\164\x73" => time()];
 L_f6e3e:
 $_0x38ca = new DashboardModel();
 goto L_6ead8;
 L_a3b7f:
 $_0x6174 = !empty($_0xe457->logo_kiri) ? $_0x2576 . ltrim($_0xe457->logo_kiri, "\x2f") : '';
 goto L_09529;
 }
 /**
 * Normalisasi URL relatif di dalam HTML soal/opsi agar gambar & audio tampil di Android Native
 */
 private function normalizeHtmlUrls(?string $_0x3f00): string
 {
 goto L_3ec83;
 L_a503c:
 $_0xe055 = rtrim(base_url(), "\x2f");
 goto L_0e763;
 L_642c7:
 return (string) $_0x3f00;
 L_3ec83:
 if ($_0x3f00 === null || $_0x3f00 === '') {
 return '';
 }
 goto L_a503c;
 L_0e763:
 // Ganti src="uploads/... atau src="/uploads/... menjadi URL absolut
 $_0x3f00 = preg_replace_callback("\x2f\50\x73\162\x63\174\x68\162\x65\146\x29\75\x5b\42\x27\135\x28\77\x21\150\x74\164\x70\163\x3f\72\x5c\57\x5c\57\x7c\144\x61\164\x61\72\x29\50\x5b\136\x22\47\x5d\53\x29\133\x22\47\x5d\57\x69", function ($_0x572a) use ($_0xe055) {
 $_0xcb51 = $_0x572a[1];
 $_0x1140 = ltrim($_0x572a[2], "\x2f");
 return $_0xcb51 . "\x3d\42" . $_0xe055 . "\x2f" . $_0x1140 . "\x22";
 }, $_0x3f00);
 goto L_642c7;
 }
 // =========================================================================
 // 1. PING & INFO SEKOLAH
 // =========================================================================
 public function ping()
 {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x43\102\x54\40\x4e\141\x74\151\x76\145\x20\101\x50\111\x20\122\x65\141\x64\171", "\x73\145\x6b\157\x6c\141\x68" => $this->getSekolahInfo()]);
 }
 // =========================================================================
 // 2. LOGIN & LOGOUT SISWA
 // =========================================================================
 public function login()
 {
 goto L_8c650;
 L_4d103:
 $_0xc2ec = trim((string) ($_0x170d["\x64\145\x76\151\x63\145\x5f\151\x6e\146\x6f"] ?? $this->request->getUserAgent()));
 goto L_b3074;
 L_33a62:
 if ($_0x227d && isset($_0x227d->status) && (string) $_0x227d->status !== "\x31") {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x75\156\x20\163\x69\163\x77\141\x20\101\x6e\144\x61\40\x73\145\x64\141\x6e\147\x20\144\x69\156\x6f\156\x61\153\x74\151\x66\153\x61\156\x20\157\x6c\145\x68\40\x41\144\x6d\151\x6e\41"], 403);
 }
 goto L_596e0;
 L_850dc:
 $_0x752e = new AuthModel();
 goto L_b6013;
 L_24183:
 // Validasi status aktif siswa
 $_0x227d = $_0x752e->isAktif($_0x9fd1->username ?? $_0xc58f);
 goto L_33a62;
 L_ea4e3:
 $_0x7674 = trim((string) ($_0x170d["\x70\141\x73\163\x77\157\x72\144"] ?? ''));
 goto L_4d103;
 L_b6013:
 $_0x9d86 = \Config\Database::connect();
 goto L_53d53;
 L_7909d:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x4c\157\x67\151\x6e\40\x62\145\x72\150\x61\163\x69\154", "\x74\157\x6b\145\x6e" => $_0xe7ee, "\x73\151\x73\167\x61" => $_0x95d5, "\x73\145\x6b\157\x6c\141\x68" => $this->getSekolahInfo()]);
 L_27f9e:
 $_0xc58f = trim((string) ($_0x170d["\x75\163\x65\162\x6e\141\x6d\145"] ?? ''));
 goto L_ea4e3;
 L_596e0:
 $_0xe6e5 = false;
 goto L_e8f77;
 L_53d53:
 // Cari di tabel users atau langsung di master_siswa
 $_0x9f3a = $_0x752e->login($_0xc58f);
 goto L_26ffa;
 L_14c12:
 $_0x95d5 = $this->enrichSiswaProfile($_0x9fd1);
 goto L_414a8;
 L_8c650:
 $_0x170d = $this->getJsonOrPost();
 goto L_27f9e;
 L_26ffa:
 $_0x9fd1 = $_0x9d86->table("\x6d\141\x73\164\x65\162\x5f\163\x69\163\x77\141")->groupStart()->where("\x75\163\x65\162\x6e\141\x6d\145", $_0xc58f)->orWhere("\x6e\151\x73", $_0xc58f)->orWhere("\x6e\151\x73\156", $_0xc58f)->groupEnd()->get()->getRow();
 goto L_f1d2e;
 L_112dd:
 // Catat di log sistem
 try {
 session()->set(["\x75\163\x65\162\x5f\151\x64" => $_0x9f3a->id ?? $_0x95d5->id_siswa, "\x69\144\x5f\165\x73\145\x72" => $_0x95d5->id_siswa, "\x69\144\x5f\163\x69\163\x77\141" => $_0x95d5->id_siswa, "\x75\163\x65\162\x6e\141\x6d\145" => $_0x95d5->username, "\x6e\141\x6d\141" => $_0x95d5->nama, "\x72\157\x6c\145" => "\x33", "\x69\163\x5f\154\x6f\147\x69\156" => true]);
 (new LogModel())->saveLog(1, "\x4c\157\x67\151\x6e\40\x41\156\x64\162\x6f\151\x64\40\x4e\141\x74\151\x76\145");
 } catch (\Throwable $_0x15e1) {
 }
 goto L_7909d;
 L_50982:
 if (!$_0xe6e5 || !$_0x9fd1) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\163\x65\162\x6e\141\x6d\145\x20\141\x74\141\x75\40\x50\141\x73\163\x77\157\x72\144\x20\163\x61\154\x61\150\x21"], 401);
 }
 goto L_0b757;
 L_414a8:
 $_0xe7ee = $this->generateToken((int) $_0x95d5->id_siswa, (string) $_0x95d5->username, $_0xc2ec);
 goto L_112dd;
 L_0b757:
 $_0x752e->resetErrorLogin($_0x9fd1->username ?? $_0xc58f);
 goto L_14c12;
 L_b3074:
 if ($_0xc58f === '' || $_0x7674 === '') {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\163\x65\162\x6e\141\x6d\145\x2f\116\x49\123\x4e\40\x64\141\x6e\40\x50\141\x73\163\x77\157\x72\144\x20\167\x61\152\x69\142\x20\144\x69\151\x73\151\x21"], 400);
 }
 goto L_850dc;
 L_f1d2e:
 if (!$_0x9f3a && $_0x9fd1 && !empty($_0x9fd1->username)) {
 $_0x9f3a = $_0x752e->login($_0x9fd1->username);
 }
 goto L_24183;
 L_e8f77:
 if ($_0x9f3a) {
 if ((string) $_0x9f3a->group_id !== "\x33") {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\160\x6c\151\x6b\141\x73\151\x20\151\x6e\151\x20\153\x68\165\x73\165\x73\40\x75\156\x74\165\x6b\40\x61\153\x75\156\x20\115\x65\155\x62\145\x72\40\x53\151\x73\167\x61\41"], 403);
 }
 if ((string) $_0x9f3a->active !== "\x31") {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x75\156\x20\101\x6e\144\x61\40\x62\145\x6c\165\x6d\40\x64\151\x61\153\x74\151\x66\153\x61\156\x20\157\x6c\145\x68\40\x41\144\x6d\151\x6e\41"], 403);
 }
 $_0xe6e5 = password_verify($_0x7674, $_0x9f3a->password) || $_0x7674 === $_0x9f3a->password;
 } elseif ($_0x9fd1) {
 // Fallback jika siswa belum disinkron ke users tapi ada password di master_siswa
 $_0xe6e5 = !empty($_0x9fd1->password) && ($_0x7674 === $_0x9fd1->password || password_verify($_0x7674, $_0x9fd1->password));
 }
 goto L_50982;
 }
 public function logout()
 {
 goto L_068d5;
 L_068d5:
 $_0x7068 = $this->request->getHeaderLine("\x41\165\x74\150\x6f\162\x69\172\x61\164\x69\157\x6e");
 goto L_387d0;
 L_08952:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x4c\157\x67\157\x75\164\x20\142\x65\162\x68\141\x73\151\x6c"]);
 L_387d0:
 if (preg_match("\x2f\102\x65\141\x72\145\x72\134\x73\53\x28\56\x2b\51\x24\57\x69", $_0x7068, $_0xdd5b)) {
 $_0x703c = trim($_0xdd5b[1]);
 if (str_contains($_0x703c, "\x2e")) {
 [, $_0x5801] = explode("\x2e", $_0x703c, 2);
 try {
 $_0x1a1e = \Config\Database::connect();
 if ($_0x1a1e->tableExists("\x63\142\x74\137\x61\160\x69\137\x74\157\x6b\145\x6e\163")) {
 $_0x1a1e->table("\x63\142\x74\137\x61\160\x69\137\x74\157\x6b\145\x6e\163")->where("\x74\157\x6b\145\x6e", substr($_0x5801, 0, 64))->delete();
 }
 } catch (\Throwable $_0x9514) {
 }
 }
 }
 goto L_08952;
 }
 // =========================================================================
 // 3. DASHBOARD / BERANDA SISWA
 // =========================================================================
 public function dashboard()
 {
 goto L_5ecaf;
 L_b019e:
 $_0x1300 = new DashboardModel();
 goto L_2e0ba;
 L_9a487:
 // 3. Pengumuman Sekolah
 $_0xe168 = [];
 goto L_b53b4;
 L_b504a:
 // 5. Jadwal Pelajaran Hari Ini
 $_0x39da = [];
 goto L_591e6;
 L_d8eca:
 if (!empty($_0xa3c8->id_kelas)) {
 try {
 $_0x64af = $_0x63c2->table("\x6b\145\x6c\141\x73\137\x6a\141\x64\167\x61\154\x5f\155\x61\164\x65\162\x69\40\x61")->select("\x61\56\x69\144\x5f\153\x6a\155\x2c\40\x61\56\x69\144\x5f\155\x61\164\x65\162\x69\54\x20\141\x2e\152\x61\144\x77\141\x6c\137\x6d\141\x74\145\x72\151\x2c\40\x61\56\x6a\145\x6e\151\x73\54\x20\142\x2e\152\x75\144\x75\154\x5f\155\x61\164\x65\162\x69\54\x20\142\x2e\153\x6f\144\x65\137\x6d\141\x74\145\x72\151\x2c\40\x63\56\x6e\141\x6d\141\x5f\155\x61\160\x65\154\x2c\40\x63\56\x6b\157\x64\145\x20\141\x73\40\x6b\157\x64\145\x5f\155\x61\160\x65\154\x2c\40\x64\56\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\146\x2e\154\x6f\147\x5f\164\x69\155\x65\54\x20\146\x2e\146\x69\156\x69\163\x68\137\x74\151\x6d\145\x2c\40\x66\56\x6e\151\x6c\141\x69\54\x20\146\x2e\143\x61\164\x61\164\x61\156")->join("\x6b\145\x6c\141\x73\137\x6d\141\x74\145\x72\151\x20\142", "\x61\56\x69\144\x5f\155\x61\164\x65\162\x69\75\x62\56\x69\144\x5f\155\x61\164\x65\162\x69\40\x41\116\x44\40\x62\56\x73\164\x61\164\x75\163\x3d\61")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\143", "\x62\56\x69\144\x5f\155\x61\160\x65\154\x3d\143\x2e\151\x64\137\x6d\141\x70\145\x6c", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x64", "\x62\56\x69\144\x5f\147\x75\162\x75\75\x64\56\x69\144\x5f\147\x75\162\x75", "\x6c\145\x66\164")->join("\x6c\157\x67\137\x6d\141\x74\145\x72\151\x20\146", "\x61\56\x69\144\x5f\153\x6a\155\x3d\146\x2e\151\x64\137\x6d\141\x74\145\x72\151\x20\101\x4e\104\x20\146\x2e\151\x64\137\x73\151\x73\167\x61\75" . $_0x63c2->escape($_0xa3c8->id_siswa), "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\164\x70", $_0xa3c8->id_tp)->where("\x61\56\x69\144\x5f\163\x6d\164", $_0xa3c8->id_smt)->where("\x61\56\x69\144\x5f\153\x65\154\x61\163", $_0xa3c8->id_kelas)->orderBy("\x61\56\x6a\141\x64\167\x61\154\x5f\155\x61\164\x65\162\x69", "\x44\105\x53\103")->orderBy("\x61\56\x69\144\x5f\153\x6a\155", "\x44\105\x53\103")->limit(8)->get()->getResult();
 } catch (\Throwable $_0x2c68) {
 }
 }
 goto L_b504a;
 L_964ae:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x73\151\x73\167\x61" => $_0xa3c8, "\x73\145\x6b\157\x6c\141\x68" => $this->getSekolahInfo(), "\x62\141\x6e\156\x65\162\x73" => $_0x8e74, "\x72\165\x6e\156\x69\156\x67\137\x74\145\x78\164" => $_0x473b, "\x70\145\x6e\147\x75\155\x75\155\x61\156" => $_0xe168, "\x74\165\x67\141\x73\137\x6c\155\x73" => $_0x64af, "\x6a\141\x64\167\x61\154\x5f\150\x61\162\x69\137\x69\156\x69" => $_0x39da, "\x63\142\x74\137\x68\141\x72\151\x5f\151\x6e\151" => $_0xde42["\x6a\141\x64\167\x61\154\x5f\150\x61\162\x69\137\x69\156\x69"], "\x63\142\x74\137\x61\153\x74\151\x66\137\x63\157\x75\156\x74" => count($_0xde42["\x6a\141\x64\167\x61\154\x5f\150\x61\162\x69\137\x69\156\x69"])]);
 L_bbe52:
 // 4. Tugas & Materi LMS Terbaru
 $_0x64af = [];
 goto L_d8eca;
 L_4bb8c:
 if (!$_0xa3c8) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\142\x65\162\x61\153\x68\151\x72\54\x20\163\x69\154\x61\153\x61\156\x20\154\x6f\147\x69\156\x20\153\x65\155\x62\141\x6c\151\x2e"], 401);
 }
 goto L_7cc33;
 L_7cc33:
 $_0x63c2 = \Config\Database::connect();
 goto L_b019e;
 L_733d4:
 try {
 $_0x473b = $_0x1300->getRunningText() ?: [];
 } catch (\Throwable $_0x2c68) {
 }
 goto L_9a487;
 L_5ecaf:
 $_0xa3c8 = $this->authenticateSiswa();
 goto L_4bb8c;
 L_b53b4:
 try {
 $_0x9a56 = $_0x63c2->table("\x70\157\x73\164\x20\141")->select("\x61\56\x69\144\x5f\160\x6f\163\x74\54\x20\141\x2e\164\x65\170\x74\54\x20\141\x2e\164\x61\156\x67\147\x61\154\x2c\40\x61\56\x75\160\x64\141\x74\145\x64\54\x20\141\x2e\144\x61\162\x69\54\x20\141\x2e\144\x61\162\x69\137\x67\162\x6f\165\x70\54\x20\142\x2e\156\x61\155\x61\137\x67\165\x72\165\x2c\40\x62\56\x66\157\x74\157")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x62", "\x61\56\x64\141\x72\151\x20\75\x20\142\x2e\151\x64\137\x67\165\x72\165", "\x6c\145\x66\164")->orderBy("\x61\56\x75\160\x64\141\x74\145\x64", "\x44\105\x53\103")->limit(10)->get()->getResult();
 foreach ($_0x9a56 as $_0x2ab6) {
 $_0x2ab6->text_clean = trim(strip_tags((string) $_0x2ab6->text));
 $_0x2ab6->text_html = $this->normalizeHtmlUrls($_0x2ab6->text);
 $_0x2ab6->penulis = !empty($_0x2ab6->nama_guru) ? $_0x2ab6->nama_guru : "\x41\144\x6d\151\x6e\151\x73\164\x72\141\x74\157\x72";
 $_0xe168[] = $_0x2ab6;
 }
 } catch (\Throwable $_0x2c68) {
 }
 goto L_bbe52;
 L_566ca:
 // 6. Ringkasan Jadwal CBT Aktif
 $_0xde42 = $this->buildCbtJadwalList($_0xa3c8);
 goto L_964ae;
 L_dab14:
 // 2. Running Text
 $_0x473b = [];
 goto L_733d4;
 L_4fd86:
 // 1. Banner Slider Aktif
 $_0x8e74 = [];
 goto L_09c70;
 L_2e0ba:
 $_0x17a7 = rtrim(base_url(), "\x2f") . "\x2f";
 goto L_4fd86;
 L_591e6:
 if (!empty($_0xa3c8->id_kelas)) {
 try {
 $_0x95c6 = (int) date("\x4e");
 // 1 (Senin) .. 7 (Minggu)
 $_0x39da = $_0x63c2->table("\x6b\145\x6c\141\x73\137\x6a\141\x64\167\x61\154\x5f\155\x61\160\x65\154\x20\141")->select("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c\54\x20\141\x2e\152\x61\155\x5f\153\x65\54\x20\141\x2e\144\x61\162\x69\54\x20\141\x2e\163\x61\155\x70\141\x69\54\x20\155\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c\54\x20\155\x2e\153\x6f\144\x65\40\x61\163\x20\153\x6f\144\x65\137\x6d\141\x70\145\x6c")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\141\x2e\151\x64\137\x6d\141\x70\145\x6c", "\x6c\145\x66\164")->where(["\x61\56\x69\144\x5f\164\x70" => $_0xa3c8->id_tp, "\x61\56\x69\144\x5f\163\x6d\164" => $_0xa3c8->id_smt, "\x61\56\x69\144\x5f\153\x65\154\x61\163" => $_0xa3c8->id_kelas, "\x61\56\x69\144\x5f\150\x61\162\x69" => $_0x95c6])->where("\x61\56\x69\144\x5f\155\x61\160\x65\154\x20\76", 0)->orderBy("\x61\56\x64\141\x72\151", "\x41\123\x43")->get()->getResult();
 } catch (\Throwable $_0x2c68) {
 }
 }
 goto L_566ca;
 L_09c70:
 try {
 $_0xe8cf = new BannerModel();
 $_0x9d4a = $_0xe8cf->getActiveBanners();
 foreach ($_0x9d4a as $_0x860a) {
 $_0x860a->gambar_url = !empty($_0x860a->gambar) ? filter_var($_0x860a->gambar, FILTER_VALIDATE_URL) ? $_0x860a->gambar : $_0x17a7 . ltrim($_0x860a->gambar, "\x2f") : '';
 $_0x8e74[] = $_0x860a;
 }
 } catch (\Throwable $_0x2c68) {
 }
 goto L_dab14;
 }
 // =========================================================================
 // 4. DAFTAR JADWAL UJIAN CBT & RIWAYAT NILAI
 // =========================================================================
 private function buildCbtJadwalList(object $_0xc02e): array
 {
 goto L_6d664;
 L_955d8:
 $_0xad24 = [];
 goto L_268d9;
 L_ec33e:
 foreach ($_0xffaa as $_0x829a) {
 $_0xb1a8 = !empty($_0x829a->bank_kelas) ? $_0x829a->bank_kelas : "\x5b\135";
 $_0xdd3b = $this->maybe_unserialize($_0xb1a8);
 $_0xa567 = [];
 if (is_array($_0xdd3b)) {
 foreach ($_0xdd3b as $_0xf9fc) {
 if (is_object($_0xf9fc)) {
 $_0xa567[] = (string) ($_0xf9fc->kelas_id ?? '');
 } elseif (is_array($_0xf9fc)) {
 $_0xa567[] = (string) ($_0xf9fc["\x6b\145\x6c\141\x73\137\x69\144"] ?? '');
 } else {
 $_0xa567[] = (string) $_0xf9fc;
 }
 }
 }
 $_0xa567 = array_filter($_0xa567);
 if (!empty($_0xa567) && !in_array("\x30", $_0xa567, true) && !in_array($_0x5944, $_0xa567, true)) {
 continue;
 }
 $_0x9c19 = empty($_0x829a->soal_agama) || $_0x829a->soal_agama === "\x2d" || $_0x829a->soal_agama === "\x30" || strtolower(trim((string) $_0x829a->soal_agama)) === strtolower(trim((string) ($_0xc02e->agama ?? '')));
 if (!$_0x9c19) {
 continue;
 }
 $_0xa25c = $_0xcb99[(int) $_0x829a->id_jadwal] ?? null;
 $_0x6f34 = 0;
 // 0 = Belum Mulai, 1 = Sedang Mengerjakan, 2 = Selesai
 if ($_0xa25c) {
 if (!empty($_0xa25c->selesai) || (string) $_0xa25c->status === "\x32") {
 $_0x6f34 = 2;
 } elseif ((string) $_0xa25c->status === "\x31") {
 $_0x6f34 = 1;
 }
 }
 $_0xa686 = (int) ($_0x829a->tampil_pg ?? 0) + (int) ($_0x829a->tampil_kompleks ?? 0) + (int) ($_0x829a->tampil_jodohkan ?? 0) + (int) ($_0x829a->tampil_isian ?? 0) + (int) ($_0x829a->tampil_esai ?? 0);
 if ($_0xa686 <= 0) {
 $_0xa686 = (int) ($_0x829a->jml_soal ?? 0);
 }
 $_0xda14 = ["\x69\144\x5f\152\x61\144\x77\141\x6c" => (int) $_0x829a->id_jadwal, "\x69\144\x5f\142\x61\156\x6b" => (int) $_0x829a->id_bank, "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0x829a->bank_kode ?? "\x2d", "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0x829a->nama_mapel ?? "\x4d\141\x74\141\x20\120\x65\154\x61\152\x61\162\x61\156", "\x6b\157\x64\145\x5f\155\x61\160\x65\154" => $_0x829a->kode_mapel ?? '', "\x6e\141\x6d\141\x5f\147\x75\162\x75" => $_0x829a->nama_guru ?? "\x2d", "\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0x829a->nama_jenis ?? "\x55\152\x69\141\x6e", "\x6b\157\x64\145\x5f\152\x65\156\x69\163" => $_0x829a->kode_jenis ?? "\x43\102\x54", "\x74\147\x6c\137\x6d\165\x6c\141\x69" => $_0x829a->tgl_mulai ?? $_0xa662, "\x74\147\x6c\137\x73\145\x6c\145\x73\141\x69" => $_0x829a->tgl_selesai ?? $_0xa662, "\x64\165\x72\141\x73\151\x5f\165\x6a\151\x61\156" => (int) ($_0x829a->durasi_ujian ?? 60), "\x74\157\x74\141\x6c\137\x73\157\x61\154" => $_0xa686, "\x6f\160\x73\151" => (int) ($_0x829a->opsi ?? 5), "\x70\141\x6b\141\x69\137\x74\157\x6b\145\x6e" => (string) ($_0x829a->token ?? "\x30") === "\x31", "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154" => (string) ($_0x829a->hasil_tampil ?? "\x30") === "\x31", "\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e" => (string) ($_0x829a->reset_login ?? "\x30") === "\x31", "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e\137\x61\153\x74\151\x66" => (string) ($_0x829a->pelanggaran ?? "\x30") === "\x31", "\x6b\141\x6d\145\x72\141\x5f\141\x6b\164\x69\146" => (int) ($_0x829a->kamera ?? 0) === 1, "\x73\164\x61\164\x75\163\x5f\165\x6a\151\x61\156" => $_0x6f34, "\x6d\165\x6c\141\x69\137\x73\151\x73\167\x61" => $_0xa25c->mulai ?? null, "\x73\145\x6c\145\x73\141\x69\137\x73\151\x73\167\x61" => $_0xa25c->selesai ?? null, "\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => $_0xa25c->lama_ujian ?? "\x30\60\x3a\60\x30\72\x30\60", "\x73\153\x6f\162\x5f\164\x6f\164\x61\154" => (string) ($_0x829a->hasil_tampil ?? "\x30") === "\x31" && $_0xa25c ? $_0xa25c->skor_total !== null ? round((float) $_0xa25c->skor_total, 2) : null : null];
 $_0x817c = date("\x59\55\x6d\55\x64", strtotime($_0x829a->tgl_mulai ?? $_0xa662));
 $_0xca43 = date("\x59\55\x6d\55\x64", strtotime($_0x829a->tgl_selesai ?? $_0xa662));
 if ($_0xa662 > $_0xca43) {
 $_0xad24[] = $_0xda14;
 } else {
 $_0xca5a[] = $_0xda14;
 }
 }
 goto L_7ce72;
 L_bfc0c:
 foreach ($_0x82f6 as $_0x65de) {
 $_0x2a48 = $this->maybe_unserialize($_0x65de->nilai_input ?? "\x7b\175");
 if (is_object($_0x2a48)) {
 $_0x65de->skor_total = $_0x2a48->skor_total ?? $_0x2a48->total_nilai ?? $_0x2a48->pg_nilai ?? null;
 $_0x65de->pg_benar = $_0x2a48->pg_benar ?? null;
 } elseif (is_array($_0x2a48)) {
 $_0x65de->skor_total = $_0x2a48["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? $_0x2a48["\x74\157\x74\141\x6c\137\x6e\151\x6c\141\x69"] ?? $_0x2a48["\x70\147\x5f\156\x69\154\x61\151"] ?? null;
 $_0x65de->pg_benar = $_0x2a48["\x70\147\x5f\142\x65\156\x61\162"] ?? null;
 } else {
 $_0x65de->skor_total = null;
 $_0x65de->pg_benar = null;
 }
 if (!empty($_0x65de->selesai) && $_0x65de->skor_total === null) {
 try {
 $_0x3759 = $this->olah_nilai(2, $_0x1d2b, $_0x4208, $_0x7e98, $_0x65de->id_jadwal, false);
 if ($_0x3759 && !empty($_0x3759->sesisiswa)) {
 $_0x3a21 = $_0x3759->sesisiswa[0]->nilai_akhir ?? null;
 if ($_0x3a21) {
 $_0x65de->skor_total = $_0x3a21->skor_total ?? $_0x3a21->pg_nilai ?? 0;
 $_0x65de->pg_benar = $_0x3a21->pg_benar ?? 0;
 }
 }
 } catch (\Throwable $_0x74fa) {
 }
 }
 $_0xcb99[(int) $_0x65de->id_jadwal] = $_0x65de;
 }
 goto L_31579;
 L_00eb3:
 $_0xd3bc->groupStart()->where("\x6a\56\x69\144\x5f\164\x70", $_0x1d2b)->orWhere("\x62\56\x69\144\x5f\164\x70", $_0x1d2b)->groupEnd();
 goto L_a9083;
 L_9e126:
 $_0x1d2b = (int) $_0xc02e->id_tp;
 goto L_5c10e;
 L_e19a0:
 $_0xcb99 = [];
 goto L_bfc0c;
 L_2cabf:
 $_0x5944 = (string) ($_0xc02e->id_kelas ?? '');
 goto L_ec33e;
 L_675ec:
 $_0x82f6 = $_0xc5e7->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\151\x64\137\x62\141\x6e\153\x2c\151\x64\137\x6a\141\x64\167\x61\154\x2c\163\x74\141\x74\165\x73\54\x6c\141\x6d\141\x5f\165\x6a\151\x61\156\x2c\155\x75\154\x61\151\x2c\163\x65\154\x65\163\x61\151\x2c\162\x65\163\x65\164\x5f\167\x61\153\x74\165\x2c\162\x65\163\x65\164\x5f\151\x7a\151\x6e\54\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74\54\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->where("\x69\144\x5f\163\x69\163\x77\141", $_0x7e98)->get()->getResult();
 goto L_e19a0;
 L_6d664:
 $_0xc5e7 = \Config\Database::connect();
 goto L_c2b1f;
 L_268d9:
 $_0xa662 = date("\x59\55\x6d\55\x64");
 goto L_2cabf;
 L_a9083:
 $_0xd3bc->groupStart()->where("\x6a\56\x69\144\x5f\163\x6d\164", $_0x4208)->orWhere("\x62\56\x69\144\x5f\163\x6d\164", $_0x4208)->groupEnd();
 goto L_16575;
 L_c2b1f:
 $_0x7e98 = (int) $_0xc02e->id_siswa;
 goto L_9e126;
 L_5c10e:
 $_0x4208 = (int) $_0xc02e->id_smt;
 goto L_675ec;
 L_b9d93:
 if (!empty($_0x71b3)) {
 $_0xd3bc->groupStart()->where("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", $_0x71b3)->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", "\x30")->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154", '')->orWhere("\x62\56\x62\141\x6e\153\x5f\154\x65\166\x65\154\x20\111\x53\40\x4e\125\x4c\114", null, false)->groupEnd();
 }
 goto L_8360b;
 L_8360b:
 $_0xffaa = $_0xd3bc->orderBy("\x6a\56\x74\147\x6c\137\x6d\165\x6c\141\x69", "\x41\123\x43")->orderBy("\x6a\56\x6a\141\x6d\137\x6b\145", "\x41\123\x43")->get()->getResult();
 goto L_aa6f1;
 L_7ce72:
 return ["\x6a\141\x64\167\x61\154\x5f\150\x61\162\x69\137\x69\156\x69" => $_0xca5a, "\x6a\141\x64\167\x61\154\x5f\162\x69\167\x61\171\x61\164" => $_0xad24];
 L_31579:
 $_0xd3bc = $_0xc5e7->table("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62")->select("\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x62\56\x62\141\x6e\153\x5f\153\x65\154\x61\163\x2c\142\x2e\142\x61\156\x6b\137\x6c\145\x76\145\x6c\54\x62\56\x6f\160\x73\151\x2c\142\x2e\152\x6d\154\x5f\163\x6f\141\x6c\54\x62\56\x74\141\x6d\160\x69\154\x5f\160\x67\54\x62\56\x62\157\x62\157\x74\137\x70\147\x2c\142\x2e\152\x6d\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x62\56\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x62\56\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\142\x2e\152\x6d\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x62\56\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x62\56\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156\x2c\142\x2e\152\x6d\154\x5f\151\x73\151\x61\156\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x69\163\x69\141\x6e\54\x62\56\x62\157\x62\157\x74\137\x69\163\x69\141\x6e\54\x62\56\x6a\155\x6c\137\x65\163\x61\151\x2c\142\x2e\164\x61\155\x70\151\x6c\137\x65\163\x61\151\x2c\142\x2e\142\x6f\142\x6f\164\x5f\145\x73\141\x69\54\x62\56\x69\144\x5f\164\x70\54\x62\56\x69\144\x5f\163\x6d\164\x2c\142\x2e\163\x6f\141\x6c\137\x61\147\x61\155\x61\54\x20\152\x2e\52\x2c\40\x6a\156\x73\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163\x2c\40\x6a\156\x73\56\x6b\157\x64\145\x5f\152\x65\156\x69\163\x2c\40\x67\56\x69\144\x5f\147\x75\162\x75\54\x67\56\x6b\157\x64\145\x5f\147\x75\162\x75\54\x67\56\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\155\x2e\151\x64\137\x6d\141\x70\145\x6c\54\x6d\56\x6b\157\x64\145\x20\141\x73\40\x6b\157\x64\145\x5f\155\x61\160\x65\154\x2c\155\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c")->join("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\152", "\x6a\56\x69\144\x5f\142\x61\156\x6b\75\x62\56\x69\144\x5f\142\x61\156\x6b\40\x41\116\x44\40\x6a\56\x73\164\x61\164\x75\163\x3d\42\x31\42", "\x69\156\x6e\145\x72")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x6a\156\x73", "\x6a\156\x73\56\x69\144\x5f\152\x65\156\x69\163\x3d\152\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->where("\x62\56\x73\164\x61\164\x75\163", "\x31");
 goto L_00eb3;
 L_16575:
 $_0x71b3 = $_0xc02e->level_id ?? null;
 goto L_b9d93;
 L_aa6f1:
 $_0xca5a = [];
 goto L_955d8;
 }
 public function cbt_jadwal()
 {
 goto L_583ef;
 L_4be91:
 if (!$_0x9c04) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"], 401);
 }
 goto L_5a459;
 L_5a459:
 $_0xf7d7 = $this->buildCbtJadwalList($_0x9c04);
 goto L_8db35;
 L_583ef:
 $_0x9c04 = $this->authenticateSiswa();
 goto L_4be91;
 L_8db35:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x73\151\x73\167\x61" => $_0x9c04, "\x6a\141\x64\167\x61\154\x5f\150\x61\162\x69\137\x69\156\x69" => $_0xf7d7["\x6a\141\x64\167\x61\154\x5f\150\x61\162\x69\137\x69\156\x69"], "\x6a\141\x64\167\x61\154\x5f\162\x69\167\x61\171\x61\164" => $_0xf7d7["\x6a\141\x64\167\x61\154\x5f\162\x69\167\x61\171\x61\164"]]);
 }
 // =========================================================================
 // 5. MULAI UJIAN / VALIDASI TOKEN & UNDUH PAKET SOAL OFFLINE-FIRST
 // =========================================================================
 public function cbt_mulai()
 {
 goto L_ee50f;
 L_2acbb:
 // Cek Token Ujian (hanya wajib jika jadwal menggunakan token & siswa baru mulai atau belum punya queue)
 if ((string) $_0xa9b7->token === "\x31" && !$_0xd964) {
 $_0x7722 = $_0x3012->getToken();
 $_0x2182 = strtoupper(trim((string) ($_0x7722->token ?? '')));
 if ($_0xdabd === '' || $_0x2182 === '' || $_0xdabd !== $_0x2182) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6e\145\x65\144\x5f\164\x6f\153\x65\156" => true, "\x6d\145\x73\163\x61\147\x65" => $_0xdabd === '' ? "\x4d\141\x73\165\x6b\153\x61\156\x20\124\x6f\153\x65\156\x20\125\x6a\151\x61\156\x20\164\x65\162\x6c\145\x62\151\x68\40\x64\141\x68\165\x6c\165\x21" : "\x54\157\x6b\145\x6e\40\x55\152\x69\141\x6e\40\x79\141\x6e\147\x20\101\x6e\144\x61\40\x6d\141\x73\165\x6b\153\x61\156\x20\163\x61\154\x61\150\x21"]);
 }
 } elseif ((string) $_0xa9b7->token === "\x31" && $_0xdabd !== '') {
 $_0x7722 = $_0x3012->getToken();
 $_0x2182 = strtoupper(trim((string) ($_0x7722->token ?? '')));
 if ($_0x2182 !== '' && $_0xdabd !== $_0x2182) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6e\145\x65\144\x5f\164\x6f\153\x65\156" => true, "\x6d\145\x73\163\x61\147\x65" => "\x54\157\x6b\145\x6e\40\x55\152\x69\141\x6e\40\x79\141\x6e\147\x20\101\x6e\144\x61\40\x6d\141\x73\165\x6b\153\x61\156\x20\163\x61\154\x61\150\x21"]);
 }
 }
 goto L_ae10c;
 L_fadc6:
 if (!$_0xa9b7 || (string) $_0xa9b7->status !== "\x31") {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\165\x6a\151\x61\156\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156\x20\141\x74\141\x75\40\x62\145\x6c\165\x6d\40\x64\151\x61\153\x74\151\x66\153\x61\156\x21"]);
 }
 goto L_dab40;
 L_f87e6:
 // Susun paket soal lengkap untuk Android Native (tanpa membocorkan kunci jawaban!)
 usort($_0x2b7b, static function ($_0x4944, $_0x79e3) {
 return (int) ($_0x4944["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? 0) <=> (int) ($_0x79e3["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? 0);
 });
 goto L_001bc;
 L_001bc:
 $_0x81fb = [];
 goto L_8e135;
 L_dab40:
 // Cek tanggal jadwal
 $_0xb823 = date("\x59\55\x6d\55\x64");
 goto L_63240;
 L_6ec7a:
 if ($_0x22fe <= 0) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\112\x61\144\x77\141\x6c\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64\41"], 400);
 }
 goto L_7ecd7;
 L_63240:
 $_0x72e0 = date("\x59\55\x6d\55\x64", strtotime($_0xa9b7->tgl_mulai ?? $_0xb823));
 goto L_af850;
 L_6af17:
 if ($_0xd964 && (!empty($_0xd964->selesai) || (string) $_0xd964->status === "\x32")) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x41\156\x64\141\x20\163\x75\144\x61\150\x20\155\x65\156\x79\145\x6c\145\x73\141\x69\153\x61\156\x20\165\x6a\151\x61\156\x20\151\x6e\151\x21"]);
 }
 goto L_2acbb;
 L_f6a0f:
 // Hitung sisa waktu ujian
 $_0xdf91 = max(1, (int) ($_0xa9b7->durasi_ujian ?? 60));
 goto L_b0634;
 L_e708a:
 if (empty($_0x7f39)) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x42\141\x6e\153\x20\163\x6f\141\x6c\40\x62\145\x6c\165\x6d\40\x6d\145\x6d\151\x6c\151\x6b\151\x20\142\x75\164\x69\162\x20\163\x6f\141\x6c\40\x61\153\x74\151\x66\41"]);
 }
 goto L_37740;
 L_4a254:
 $_0x855c = "\x45\170\x61\155\x62\162\x6f\101\x6e\144\x72\157\x69\144\x4e\141\x74\151\x76\145\x2f\62\x2e\60";
 goto L_51424;
 L_988bf:
 if ($_0x74f7 <= 0) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x65\170\x70\151\x72\145\x64" => true, "\x6d\145\x73\163\x61\147\x65" => "\x57\141\x6b\164\x75\40\x70\145\x6e\147\x65\162\x6a\141\x61\156\x20\165\x6a\151\x61\156\x20\101\x6e\144\x61\40\x73\165\x64\141\x68\40\x68\141\x62\151\x73\41"]);
 }
 goto L_3e061;
 L_37740:
 // Cek atau buat queue jawaban siswa
 $_0xb9c0 = (object) ["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xa9b7->id_jadwal, "\x61\143\x61\153\x5f\163\x6f\141\x6c" => $_0xa9b7->acak_soal, "\x61\143\x61\153\x5f\157\x70\163\x69" => $_0xa9b7->acak_opsi, "\x62\141\x6e\153" => (object) ["\x69\144\x5f\142\x61\156\x6b" => $_0xa9b7->id_bank, "\x6f\160\x73\151" => $_0xa9b7->opsi, "\x74\141\x6d\160\x69\154\x5f\160\x67" => $_0xa9b7->tampil_pg, "\x62\157\x62\157\x74\137\x70\147" => $_0xa9b7->bobot_pg, "\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73" => $_0xa9b7->tampil_kompleks, "\x62\157\x62\157\x74\137\x6b\157\x6d\160\x6c\145\x6b\163" => $_0xa9b7->bobot_kompleks, "\x74\141\x6d\160\x69\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e" => $_0xa9b7->tampil_jodohkan, "\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156" => $_0xa9b7->bobot_jodohkan, "\x74\141\x6d\160\x69\154\x5f\151\x73\151\x61\156" => $_0xa9b7->tampil_isian, "\x62\157\x62\157\x74\137\x69\163\x69\141\x6e" => $_0xa9b7->bobot_isian, "\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69" => $_0xa9b7->tampil_esai, "\x62\157\x62\157\x74\137\x65\163\x61\151" => $_0xa9b7->bobot_esai, "\x73\157\x61\154" => $_0x7f39]];
 goto L_86c8e;
 L_7cc8f:
 $_0x2d55 = $this->getJsonOrPost();
 goto L_df3fd;
 L_d56c2:
 (new \App\Models\CbtModel())->ensureHotsSchema();
 goto L_b189f;
 L_339ae:
 // Cek status cbt_siswa yang sudah ada
 $_0xd964 = $_0x1d74->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x22fe, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x2450->id_siswa])->get()->getRow();
 goto L_6af17;
 L_2a372:
 if ($_0xb823 > $_0xa628) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\165\x6a\151\x61\156\x20\163\x75\144\x61\150\x20\142\x65\162\x61\153\x68\151\x72\41"]);
 }
 goto L_2b752;
 L_ee50f:
 $_0x2450 = $this->authenticateSiswa();
 goto L_68383;
 L_ae10c:
 // Identitas perangkat Android Native
 $_0x70ba = $this->request->getIPAddress();
 goto L_4a254;
 L_ec50e:
 $_0xdabd = strtoupper(trim((string) ($_0x2d55["\x74\157\x6b\145\x6e"] ?? '')));
 goto L_6ec7a;
 L_1c846:
 $_0x74f7 = max(0, $_0x4b37 - $_0x1217);
 goto L_988bf;
 L_af850:
 $_0xa628 = date("\x59\55\x6d\55\x64", strtotime($_0xa9b7->tgl_selesai ?? $_0xb823));
 goto L_6ef80;
 L_51424:
 $_0xfe11 = "\x41\156\x64\162\x6f\151\x64\40\x4e\141\x74\151\x76\145";
 goto L_9aba3;
 L_2f686:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x53\157\x61\154\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x6d\165\x61\164", "\x6a\141\x64\167\x61\154" => ["\x69\144\x5f\152\x61\144\x77\141\x6c" => (int) $_0xa9b7->id_jadwal, "\x69\144\x5f\142\x61\156\x6b" => (int) $_0xa9b7->id_bank, "\x62\141\x6e\153\x5f\153\x6f\144\x65" => $_0xa9b7->bank_kode ?? '', "\x6e\141\x6d\141\x5f\155\x61\160\x65\154" => $_0xa9b7->nama_mapel ?? '', "\x6e\141\x6d\141\x5f\152\x65\156\x69\163" => $_0xa9b7->nama_jenis ?? '', "\x64\165\x72\141\x73\151\x5f\155\x65\156\x69\164" => $_0xdf91, "\x64\145\x74\151\x6b\137\x62\145\x72\152\x61\154\x61\156" => $_0x1217, "\x73\151\x73\141\x5f\144\x65\164\x69\153" => $_0x74f7, "\x6a\141\x72\141\x6b\137\x64\145\x74\151\x6b" => (int) ($_0xa9b7->jarak ?? 0), "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154" => (string) ($_0xa9b7->hasil_tampil ?? "\x30") === "\x31", "\x72\145\x73\145\x74\137\x6c\157\x67\151\x6e" => (string) ($_0xa9b7->reset_login ?? "\x30") === "\x31", "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e\137\x61\153\x74\151\x66" => (string) ($_0xa9b7->pelanggaran ?? "\x30") === "\x31", "\x6b\141\x6d\145\x72\141\x5f\141\x6b\164\x69\146" => (int) ($_0xa9b7->kamera ?? 0) === 1], "\x74\157\x74\141\x6c\137\x73\157\x61\154" => count($_0x81fb), "\x73\157\x61\154\x5f\154\x69\163\x74" => $_0x81fb]);
 L_68274:
 foreach ($_0x7f39 as $_0x33a3) {
 $_0x20f0[(int) $_0x33a3->id_soal] = $_0x33a3;
 }
 goto L_f87e6;
 L_86c8e:
 if (!$_0xd964) {
 $_0x2b7b = $this->buildQuestionQueue($_0xb9c0);
 $_0x6672 = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 $_0x1d74->table("\x63\142\x74\137\x73\151\x73\167\x61")->insert(["\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x2450->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x22fe, "\x69\144\x5f\142\x61\156\x6b" => (int) $_0xa9b7->id_bank, "\x6a\141\x77\141\x62\141\x6e" => json_encode($_0x2b7b), "\x6e\151\x6c\141\x69" => "\x5b\135", "\x6e\151\x6c\141\x69\137\x69\156\x70\165\x74" => "\x7b\175", "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => "\x30", "\x72\145\x73\145\x74\137\x69\172\x69\156" => "\x30", "\x73\164\x61\164\x75\163" => "\x31", "\x6d\165\x6c\141\x69" => $_0x6672, "\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => "\x30\60\x3a\60\x30\72\x30\60"]);
 $_0x1d74->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->insert(["\x69\144\x5f\154\x6f\147" => (int) $_0x2450->id_siswa . "\x30" . $_0x22fe . "\x31", "\x6c\157\x67\137\x74\151\x6d\145" => $_0x6672, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x2450->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x22fe, "\x6c\157\x67\137\x74\171\x70\145" => 1, "\x6c\157\x67\137\x64\145\x73\143" => "\x4d\145\x6d\165\x6c\141\x69\40\x55\152\x69\141\x6e\40\x28\101\x6e\144\x72\157\x69\144\x20\116\x61\164\x69\166\x65\51", "\x61\144\x64\162\x65\163\x73" => $_0x70ba, "\x61\147\x65\156\x74" => $_0x855c, "\x64\145\x76\151\x63\145" => $_0xfe11, "\x72\145\x73\145\x74" => 0]);
 $_0xd964 = $_0x1d74->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x22fe, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x2450->id_siswa])->get()->getRow();
 } else {
 // Cek jika ada reset_waktu dari pengawas
 if (!empty($_0xd964->reset_waktu) && (string) $_0xd964->reset_waktu !== "\x30") {
 if ((string) $_0xd964->reset_waktu === "\x31" || (string) $_0xd964->reset_waktu === "\x33") {
 $_0x1d74->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xd964->id_cbt_siswa)->update(["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156" => "\x30\60\x3a\60\x30\72\x30\60", "\x6d\165\x6c\141\x69" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x72\145\x73\145\x74\137\x77\141\x6b\164\x75" => 0]);
 $_0xd964->mulai = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 $_0xd964->lama_ujian = "\x30\60\x3a\60\x30\72\x30\60";
 }
 }
 $_0x2b7b = json_decode((string) $_0xd964->jawaban, true);
 if (!is_array($_0x2b7b) || empty($_0x2b7b)) {
 $_0x2b7b = $this->buildQuestionQueue($_0xb9c0);
 $_0x1d74->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xd964->id_cbt_siswa)->update(["\x6a\141\x77\141\x62\141\x6e" => json_encode($_0x2b7b)]);
 }
 }
 goto L_f6a0f;
 L_6ef80:
 if ($_0xb823 < $_0x72e0) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4a\141\x64\167\x61\154\x20\165\x6a\151\x61\156\x20\142\x65\154\x75\155\x20\144\x69\155\x75\154\x61\151\x20\50\x4d\165\x6c\141\x69\72\x20" . $_0x72e0 . "\x29"]);
 }
 goto L_2a372;
 L_b189f:
 // Ambil seluruh butir soal yang ditampilkan
 $_0x7f39 = $_0x1d74->table("\x63\142\x74\137\x73\157\x61\154")->where(["\x62\141\x6e\153\x5f\151\x64" => $_0xa9b7->id_bank, "\x74\141\x6d\160\x69\154\x6b\141\x6e" => "\x31"])->get()->getResult();
 goto L_e708a;
 L_9aba3:
 // Cek Reset Login / Izin Pengawas
 if ($_0xd964 && (string) $_0xa9b7->reset_login === "\x31") {
 $_0xd3fc = $_0x1d74->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x22fe, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x2450->id_siswa, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->orderBy("\x69\144\x5f\154\x6f\147", "\x44\105\x53\103")->get()->getRow();
 if ($_0xd3fc) {
 $_0xa9a3 = $_0xd3fc->agent === $_0x855c && $_0xd3fc->device === $_0xfe11;
 if (!$_0xa9a3) {
 if ((string) $_0xd964->reset_izin === "\x31") {
 $_0x1d74->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where("\x69\144\x5f\154\x6f\147", $_0xd3fc->id_log)->update(["\x61\144\x64\162\x65\163\x73" => $_0x70ba, "\x61\147\x65\156\x74" => $_0x855c, "\x64\145\x76\151\x63\145" => $_0xfe11]);
 $_0x1d74->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xd964->id_cbt_siswa)->update(["\x72\145\x73\145\x74\137\x69\172\x69\156" => "\x30"]);
 } else {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6e\145\x65\144\x5f\162\x65\163\x65\164\x5f\151\x7a\151\x6e" => true, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x75\156\x20\165\x6a\151\x61\156\x20\101\x6e\144\x61\40\x74\145\x72\153\x75\156\x63\151\x20\153\x61\162\x65\156\x61\40\x74\145\x72\144\x65\164\x65\153\x73\151\x20\153\x65\154\x75\141\x72\40\x61\164\x61\165\x20\142\x65\162\x67\141\x6e\164\x69\40\x70\145\x72\141\x6e\147\x6b\141\x74\56\x20\123\x69\154\x61\153\x61\156\x20\155\x69\156\x74\141\x20\122\x65\163\x65\164\x20\111\x7a\151\x6e\40\x6b\145\x20\120\x65\156\x67\141\x77\141\x73\40\x55\152\x69\141\x6e\41"]);
 }
 }
 }
 }
 goto L_d56c2;
 L_df3fd:
 $_0x22fe = (int) ($_0x2d55["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? $_0x2d55["\x6a\141\x64\167\x61\154"] ?? 0);
 goto L_ec50e;
 L_2b752:
 // Cek jam sesi siswa
 if (!empty($_0x2450->waktu_mulai) && !empty($_0x2450->waktu_akhir)) {
 $_0xeada = new \DateTime();
 $_0xdd61 = new \DateTime($_0x2450->waktu_mulai);
 $_0xc441 = new \DateTime($_0x2450->waktu_akhir);
 if ($_0xc441 < $_0xdd61) {
 $_0xc441->modify("\x2b\61\x20\144\x61\171");
 }
 if ($_0xeada < $_0xdd61) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x53\145\x73\151\x20\165\x6a\151\x61\156\x20\101\x6e\144\x61\40\x28" . $_0x2450->nama_sesi . "\x29\40\x62\141\x72\165\x20\144\x69\155\x75\154\x61\151\x20\160\x75\153\x75\154\x20" . substr($_0x2450->waktu_mulai, 0, 5)]);
 }
 if ($_0xeada > $_0xc441) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x57\141\x6b\164\x75\40\x73\145\x73\151\x20\165\x6a\151\x61\156\x20\101\x6e\144\x61\40\x28" . $_0x2450->nama_sesi . "\x29\40\x73\165\x64\141\x68\40\x62\145\x72\141\x6b\150\x69\162\x21"]);
 }
 }
 goto L_339ae;
 L_8e135:
 foreach ($_0x2b7b as $_0x5ee3 => $_0x1667) {
 $_0x9614 = (int) ($_0x1667["\x69\144\x5f\163\x6f\141\x6c"] ?? 0);
 $_0xa570 = $_0x20f0[$_0x9614] ?? null;
 if (!$_0xa570) {
 continue;
 }
 $_0x8a51 = (string) ($_0xa570->jenis ?? "\x31");
 $_0x8a87 = (int) ($_0x1667["\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73"] ?? $_0x5ee3 + 1);
 $_0xc925 = $_0x1667["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? null;
 $_0x1b67 = [];
 $_0xb8a6 = null;
 $_0x27cf = 1;
 if ($_0x8a51 === "\x31") {
 // Pilihan Ganda
 $_0x7730 = ["\x41", "\x42", "\x43", "\x44", "\x45"];
 $_0x753b = $_0xa570->opsi_a ?? '';
 if (!empty($_0x753b) && is_string($_0x753b)) {
 $_0xc6a6 = $this->maybe_unserialize($_0x753b);
 $_0x847f = is_string($_0xc6a6) ? json_decode($_0xc6a6, true) : $_0xc6a6;
 if (is_array($_0x847f)) {
 foreach ($_0x7730 as $_0x3802) {
 $_0xaa50 = strtolower($_0x3802);
 if (isset($_0x847f[$_0x3802]) || isset($_0x847f[$_0xaa50])) {
 $_0xa570->{"\x6f\160\x73\151\x5f" . $_0xaa50} = $_0x847f[$_0x3802] ?? $_0x847f[$_0xaa50];
 }
 }
 }
 }
 foreach ($_0x7730 as $_0x4645) {
 $_0xbcc2 = "\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f" . strtolower($_0x4645);
 $_0x4574 = "\x6f\160\x73\151\x5f" . strtolower($_0x4645);
 $_0xa998 = !empty($_0x1667[$_0xbcc2]) ? $_0x1667[$_0xbcc2] : $_0x4645;
 $_0xc021 = $_0xa570->{$_0x4574} ?? '';
 if ($_0xc021 !== null && trim((string) $_0xc021) !== '') {
 $_0x1b67[] = [
 "\x6b\157\x64\145\x5f\141\x73\154\x69" => $_0x4645,
 // dikirim kembali saat simpan jawaban (value)
 "\x6b\157\x64\145\x5f\164\x61\155\x70\151\x6c" => $_0xa998,
 // label huruf yang tampil di layar (A/B/C/D/E)
 "\x74\145\x6b\163\x5f\150\x74\155\x6c" => $this->normalizeHtmlUrls((string) $_0xc021),
 "\x74\145\x6b\163\x5f\160\x6c\141\x69\156" => trim(html_entity_decode(strip_tags((string) $_0xc021))),
 ];
 }
 }
 usort($_0x1b67, static function ($_0x4944, $_0x79e3) {
 return ($_0x4944["\x6b\157\x64\145\x5f\164\x61\155\x70\151\x6c"] ?? '') <=> ($_0x79e3["\x6b\157\x64\145\x5f\164\x61\155\x70\151\x6c"] ?? '');
 });
 } elseif ($_0x8a51 === "\x32") {
 // Pilihan Ganda Kompleks
 $_0x62f2 = $_0xa570->opsi_a ?? [];
 if (is_string($_0x62f2)) {
 $_0x61aa = $this->maybe_unserialize($_0x62f2);
 $_0x62f2 = is_string($_0x61aa) ? json_decode($_0x61aa, true) ?? $_0x61aa : $_0x61aa;
 }
 $_0xe176 = is_object($_0x62f2) ? (array) $_0x62f2 : (is_array($_0x62f2) ? $_0x62f2 : []);
 if (empty($_0xe176)) {
 foreach (["\x41", "\x42", "\x43", "\x44", "\x45"] as $_0x3802) {
 $_0xa03e = "\x6f\160\x73\151\x5f" . strtolower($_0x3802);
 if (!empty($_0xa570->{$_0xa03e}) && trim((string) $_0xa570->{$_0xa03e}) !== '') {
 $_0xe176[$_0x3802] = $_0xa570->{$_0xa03e};
 }
 }
 }
 foreach ($_0xe176 as $_0xc8b2 => $_0x8a2d) {
 if ($_0x8a2d === null || trim((string) $_0x8a2d) === '') {
 continue;
 }
 $_0xce1d = strtoupper((string) $_0xc8b2);
 $_0x1b67[] = ["\x6b\157\x64\145\x5f\141\x73\154\x69" => $_0xce1d, "\x6b\157\x64\145\x5f\164\x61\155\x70\151\x6c" => $_0xce1d, "\x74\145\x6b\163\x5f\150\x74\155\x6c" => $this->normalizeHtmlUrls((string) $_0x8a2d), "\x74\145\x6b\163\x5f\160\x6c\141\x69\156" => trim(html_entity_decode(strip_tags((string) $_0x8a2d)))];
 }
 $_0x27cf = max(1, count($_0x1b67));
 } elseif ($_0x8a51 === "\x33") {
 // Menjodohkan (baris pernyataan kiri & kolom pilihan kanan)
 $_0xe302 = $_0xa570->jawaban ?? [];
 if (is_string($_0xe302)) {
 $_0x61aa = $this->maybe_unserialize($_0xe302);
 $_0xe302 = is_string($_0x61aa) ? json_decode($_0x61aa, true) ?? $_0x61aa : $_0x61aa;
 }
 $_0x8171 = is_object($_0xe302) ? (array) $_0xe302 : (is_array($_0xe302) ? $_0xe302 : []);
 $_0xf7e6 = isset($_0x8171["\x6a\141\x77\141\x62\141\x6e"]) ? (array) $_0x8171["\x6a\141\x77\141\x62\141\x6e"] : [];
 if (empty($_0xf7e6) && !empty($_0xa570->opsi_a)) {
 $_0xf22e = $_0xa570->opsi_a;
 if (is_string($_0xf22e)) {
 $_0xe715 = $this->maybe_unserialize($_0xf22e);
 $_0xf22e = is_string($_0xe715) ? json_decode($_0xe715, true) ?? $_0xe715 : $_0xe715;
 }
 if (is_object($_0xf22e)) {
 $_0xf22e = (array) $_0xf22e;
 }
 if (is_array($_0xf22e) && isset($_0xf22e["\x6a\141\x77\141\x62\141\x6e"])) {
 $_0xf7e6 = (array) $_0xf22e["\x6a\141\x77\141\x62\141\x6e"];
 } elseif (is_array($_0xf22e)) {
 $_0xf7e6 = $_0xf22e;
 }
 }
 $_0xc20b = [];
 $_0x12b6 = [];
 if (!empty($_0xf7e6)) {
 $_0xf7e6 = array_values($_0xf7e6);
 foreach ($_0xf7e6 as $_0xa313 => $_0x802f) {
 $_0xe6a0 = array_values((array) $_0x802f);
 if ($_0xa313 === 0) {
 // Header kolom kanan (mulai dari index 1)
 for ($_0x25c4 = 1; $_0x25c4 < count($_0xe6a0); $_0x25c4++) {
 $_0xc20b[] = (string) $_0xe6a0[$_0x25c4];
 }
 } else if (isset($_0xe6a0[0]) && trim((string) $_0xe6a0[0]) !== '') {
 $_0x12b6[] = (string) $_0xe6a0[0];
 }
 }
 }
 $_0xb8a6 = ["\x62\141\x72\151\x73\137\x6b\151\x72\151" => $_0x12b6, "\x6b\157\x6c\157\x6d\137\x6b\141\x6e\141\x6e" => $_0xc20b, "\x6d\157\x64\145\x6c" => (string) ($_0x8171["\x6d\157\x64\145\x6c"] ?? "\x32"), "\x74\171\x70\145" => (string) ($_0x8171["\x74\171\x70\145"] ?? "\x32")];
 }
 $_0x81fb[] = ["\x69\144\x5f\163\x6f\141\x6c" => $_0x9614, "\x6e\157\x6d\157\x72\137\x74\141\x6d\160\x69\154" => $_0x8a87, "\x6a\145\x6e\151\x73" => (int) $_0x8a51, "\x73\157\x61\154\x5f\150\x74\155\x6c" => $this->normalizeHtmlUrls((string) $_0xa570->soal), "\x73\157\x61\154\x5f\160\x6c\141\x69\156" => trim(html_entity_decode(strip_tags((string) $_0xa570->soal))), "\x6f\160\x73\151" => $_0x1b67, "\x6a\157\x64\157\x68\153\x61\156" => $_0xb8a6, "\x6d\141\x78\137\x70\151\x6c\151\x68" => $_0x27cf, "\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61" => $_0xc925, "\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73" => $_0x1667["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] ?? '', "\x69\163\x5f\150\x6f\164\x73" => (int) ($_0xa570->is_hots ?? 0)];
 }
 goto L_2f686;
 L_68383:
 if (!$_0x2450) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"], 401);
 }
 goto L_7cc8f;
 L_b0634:
 $_0x4b37 = $_0xdf91 * 60;
 goto L_74c45;
 L_4683c:
 // Ambil detail jadwal & bank soal
 $_0xa9b7 = $_0x1d74->table("\x63\142\x74\137\x6a\141\x64\167\x61\154\x20\141")->select("\x61\56\x2a\54\x20\142\x2e\151\x64\137\x62\141\x6e\153\x2c\40\x62\56\x62\141\x6e\153\x5f\153\x6f\144\x65\54\x20\142\x2e\142\x61\156\x6b\137\x6c\145\x76\145\x6c\54\x20\142\x2e\142\x61\156\x6b\137\x6b\145\x6c\141\x73\54\x20\142\x2e\157\x70\163\x69\54\x20\142\x2e\152\x6d\154\x5f\163\x6f\141\x6c\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x70\147\x2c\40\x62\56\x62\157\x62\157\x74\137\x70\147\x2c\40\x62\56\x6a\155\x6c\137\x6b\157\x6d\160\x6c\145\x6b\163\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\153\x6f\155\x70\154\x65\153\x73\54\x20\142\x2e\152\x6d\154\x5f\152\x6f\144\x6f\150\x6b\141\x6e\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x6a\157\x64\157\x68\153\x61\156\x2c\40\x62\56\x62\157\x62\157\x74\137\x6a\157\x64\157\x68\153\x61\156\x2c\40\x62\56\x6a\155\x6c\137\x69\163\x69\141\x6e\54\x20\142\x2e\164\x61\155\x70\151\x6c\137\x69\163\x69\141\x6e\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\151\x73\151\x61\156\x2c\40\x62\56\x6a\155\x6c\137\x65\163\x61\151\x2c\40\x62\56\x74\141\x6d\160\x69\154\x5f\145\x73\141\x69\54\x20\142\x2e\142\x6f\142\x6f\164\x5f\145\x73\141\x69\54\x20\142\x2e\151\x64\137\x74\160\x2c\40\x62\56\x69\144\x5f\163\x6d\164\x2c\40\x62\56\x73\157\x61\154\x5f\141\x67\141\x6d\141\x2c\40\x6a\156\x73\56\x6e\141\x6d\141\x5f\152\x65\156\x69\163\x2c\40\x6a\156\x73\56\x6b\157\x64\145\x5f\152\x65\156\x69\163\x2c\40\x67\56\x6e\141\x6d\141\x5f\147\x75\162\x75\54\x20\155\x2e\156\x61\155\x61\137\x6d\141\x70\145\x6c\54\x20\155\x2e\153\x6f\144\x65\40\x61\163\x20\153\x6f\144\x65\137\x6d\141\x70\145\x6c")->join("\x63\142\x74\137\x62\141\x6e\153\x5f\163\x6f\141\x6c\40\x62", "\x62\56\x69\144\x5f\142\x61\156\x6b\75\x61\56\x69\144\x5f\142\x61\156\x6b", "\x6c\145\x66\164")->join("\x63\142\x74\137\x6a\145\x6e\151\x73\40\x6a\156\x73", "\x6a\156\x73\56\x69\144\x5f\152\x65\156\x69\163\x3d\141\x2e\151\x64\137\x6a\145\x6e\151\x73", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\147\x75\162\x75\40\x67", "\x67\56\x69\144\x5f\147\x75\162\x75\75\x62\56\x62\141\x6e\153\x5f\147\x75\162\x75\137\x69\144", "\x6c\145\x66\164")->join("\x6d\141\x73\164\x65\162\x5f\155\x61\160\x65\154\x20\155", "\x6d\56\x69\144\x5f\155\x61\160\x65\154\x3d\142\x2e\142\x61\156\x6b\137\x6d\141\x70\145\x6c\137\x69\144", "\x6c\145\x66\164")->where("\x61\56\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x22fe)->get()->getRow();
 goto L_fadc6;
 L_7ecd7:
 $_0x1d74 = \Config\Database::connect();
 goto L_85ec1;
 L_a7432:
 $_0x1217 = max(0, time() - $_0xe0ee);
 goto L_1c846;
 L_74c45:
 $_0xe0ee = strtotime($_0xd964->mulai ?: date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"));
 goto L_a7432;
 L_3e061:
 // Petakan soal by id_soal
 $_0x20f0 = [];
 goto L_68274;
 L_85ec1:
 $_0x3012 = new CbtModel();
 goto L_4683c;
 }
 private function buildQuestionQueue(object $_0x5f29): array
 {
 goto L_d536f;
 L_8c0ce:
 $_0x9d2d = (string) ($_0x5f29->bank->opsi ?? "\x35");
 goto L_d2932;
 L_1d546:
 $_0x7b12 = (string) ($_0x5f29->acak_soal ?? "\x30") === "\x31";
 goto L_0604e;
 L_24a67:
 foreach ($_0x74de as $_0x866b) {
 if (($_0x866b->tampilkan ?? "\x31") != "\x31") {
 continue;
 }
 $_0x842d = (string) ($_0x866b->jenis ?? "\x31");
 $_0xa2f0[$_0x842d][] = $_0x866b;
 }
 goto L_fc055;
 L_71b97:
 $_0xa2f0 = ["\x31" => [], "\x32" => [], "\x33" => [], "\x34" => [], "\x35" => []];
 goto L_24a67;
 L_fc1f1:
 $_0x74de = $_0x5f29->bank->soal ?? [];
 goto L_baba1;
 L_84148:
 return $_0xbe2d;
 L_76a08:
 foreach (["\x31", "\x32", "\x33", "\x34", "\x35"] as $_0x842d) {
 $_0x59c3 = $_0xa2f0[$_0x842d] ?? [];
 if (empty($_0x59c3)) {
 continue;
 }
 usort($_0x59c3, static function ($_0xdf16, $_0xefb1) {
 return ($_0xdf16->nomor_soal ?? 0) <=> ($_0xefb1->nomor_soal ?? 0);
 });
 if ($_0x7b12) {
 shuffle($_0x59c3);
 }
 $_0xf300 = $_0xee3c[$_0x842d] ?? 0;
 if ($_0xf300 > 0 && $_0xf300 < count($_0x59c3)) {
 $_0x59c3 = array_slice($_0x59c3, 0, $_0xf300);
 }
 foreach ($_0x59c3 as $_0x866b) {
 $_0x5c22 = ["\x69\144\x5f\142\x61\156\x6b" => $_0x5f29->bank->id_bank, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x5f29->id_jadwal, "\x69\144\x5f\163\x6f\141\x6c" => $_0x866b->id_soal, "\x6a\145\x6e\151\x73" => $_0x842d, "\x6e\157\x5f\163\x6f\141\x6c\137\x61\154\x69\141\x73" => $_0x45c0, "\x6a\141\x77\141\x62\141\x6e\137\x62\145\x6e\141\x72" => $this->maybe_unserialize($_0x866b->jawaban ?? ''), "\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73" => null, "\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61" => null];
 if ($_0x842d === "\x31") {
 $_0x833f = $_0x3554;
 if ($_0xbe98) {
 shuffle($_0x833f);
 }
 $_0x5c22["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\141"] = $_0x833f[0] ?? "\x41";
 $_0x5c22["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\142"] = $_0x833f[1] ?? "\x42";
 $_0x5c22["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\143"] = $_0x833f[2] ?? "\x43";
 $_0x5c22["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\144"] = $_0x833f[3] ?? "\x44";
 $_0x5c22["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\145"] = $_0x833f[4] ?? "\x45";
 $_0x5c22["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0x5f29->bank->bobot_pg ?? 0) > 0 && ($_0x5f29->bank->tampil_pg ?? 0) > 0 ? round($_0x5f29->bank->bobot_pg / $_0x5f29->bank->tampil_pg, 2) : 0;
 } elseif ($_0x842d === "\x32") {
 $_0x5c22["\x6f\160\x73\151\x5f\141\x6c\151\x61\163\x5f\141"] = "\x41";
 $_0x5c22["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0x5f29->bank->bobot_kompleks ?? 0) > 0 && ($_0x5f29->bank->tampil_kompleks ?? 0) > 0 ? round($_0x5f29->bank->bobot_kompleks / $_0x5f29->bank->tampil_kompleks, 2) : 0;
 } elseif ($_0x842d === "\x33") {
 $_0x5c22["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0x5f29->bank->bobot_jodohkan ?? 0) > 0 && ($_0x5f29->bank->tampil_jodohkan ?? 0) > 0 ? round($_0x5f29->bank->bobot_jodohkan / $_0x5f29->bank->tampil_jodohkan, 2) : 0;
 } elseif ($_0x842d === "\x34") {
 $_0x5c22["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0x5f29->bank->bobot_isian ?? 0) > 0 && ($_0x5f29->bank->tampil_isian ?? 0) > 0 ? round($_0x5f29->bank->bobot_isian / $_0x5f29->bank->tampil_isian, 2) : 0;
 } elseif ($_0x842d === "\x35") {
 $_0x5c22["\x70\157\x69\156\x74\137\x73\157\x61\154"] = ($_0x5f29->bank->bobot_esai ?? 0) > 0 && ($_0x5f29->bank->tampil_esai ?? 0) > 0 ? round($_0x5f29->bank->bobot_esai / $_0x5f29->bank->tampil_esai, 2) : 0;
 }
 $_0xbe2d[] = $_0x5c22;
 $_0x45c0++;
 }
 }
 goto L_84148;
 L_31e5e:
 $_0x488c = ["\x32" => ["\x41", "\x42"], "\x33" => ["\x41", "\x42", "\x43"], "\x34" => ["\x41", "\x42", "\x43", "\x44"]];
 goto L_9d0a7;
 L_d536f:
 $_0xbe2d = [];
 goto L_fc1f1;
 L_0604e:
 $_0xbe98 = (string) ($_0x5f29->acak_opsi ?? "\x30") === "\x31";
 goto L_76a08;
 L_baba1:
 if (empty($_0x74de)) {
 return $_0xbe2d;
 }
 goto L_31e5e;
 L_fc055:
 $_0xee3c = ["\x31" => (int) ($_0x5f29->bank->tampil_pg ?? 0), "\x32" => (int) ($_0x5f29->bank->tampil_kompleks ?? 0), "\x33" => (int) ($_0x5f29->bank->tampil_jodohkan ?? 0), "\x34" => (int) ($_0x5f29->bank->tampil_isian ?? 0), "\x35" => (int) ($_0x5f29->bank->tampil_esai ?? 0)];
 goto L_fcded;
 L_fcded:
 $_0x45c0 = 1;
 goto L_1d546;
 L_d2932:
 $_0x3554 = $_0x488c[$_0x9d2d] ?? $_0x780d;
 goto L_71b97;
 L_9d0a7:
 $_0x780d = ["\x41", "\x42", "\x43", "\x44", "\x45"];
 goto L_8c0ce;
 }
 // =========================================================================
 // 6. SIMPAN JAWABAN (SINGLE ATAU BATCH OFFLINE-SYNC)
 // =========================================================================
 public function cbt_simpan_jawaban()
 {
 goto L_eb728;
 L_31ce0:
 // Cek apakah pengawas sedang meminta pantau kamera
 $_0x8181 = false;
 goto L_b7d73;
 L_9d4e4:
 $_0x8950 = json_decode((string) $_0xbc88->jawaban, true);
 goto L_6a649;
 L_70670:
 // Ambil daftar item jawaban yang dikirim (bisa 1 item atau array items)
 $_0x8b76 = [];
 goto L_d89d1;
 L_5af6b:
 $_0xb6f7 = ["\x6a\141\x77\141\x62\141\x6e" => json_encode($_0x8950)];
 goto L_c4a7a;
 L_e6062:
 foreach ($_0x8950 as $_0x8aad) {
 $_0x4f8a = $_0x8aad["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? null;
 if ($_0x4f8a !== null && $_0x4f8a !== '' && $_0x4f8a !== [] && $_0x4f8a !== "\x5b\135") {
 $_0xa5f2++;
 }
 }
 goto L_31ce0;
 L_5b3bc:
 if (!$_0xbc88) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\163\x65\163\x69\40\x75\152\x69\141\x6e\40\x74\151\x64\141\x6b\40\x64\151\x74\145\x6d\165\x6b\141\x6e\41"], 404);
 }
 goto L_43a1b;
 L_4253d:
 foreach ($_0x8b76 as $_0xfdea) {
 if (!is_array($_0xfdea)) {
 $_0xfdea = (array) $_0xfdea;
 }
 $_0x799a = (string) ($_0xfdea["\x69\144\x5f\163\x6f\141\x6c"] ?? '');
 if ($_0x799a === '') {
 continue;
 }
 foreach ($_0x8950 as $_0x21d2 => $_0x6b2a) {
 if ((string) ($_0x6b2a["\x69\144\x5f\163\x6f\141\x6c"] ?? '') === $_0x799a) {
 $_0x21c9 = (int) ($_0xfdea["\x6a\145\x6e\151\x73"] ?? $_0x6b2a["\x6a\145\x6e\151\x73"] ?? 1);
 $_0xd55e = $_0xfdea["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? '';
 if ($_0x21c9 === 1) {
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = (string) $_0xd55e;
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] = (string) ($_0xfdea["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] ?? $_0xd55e);
 } elseif ($_0x21c9 === 2) {
 if (is_string($_0xd55e)) {
 $_0xe3f9 = json_decode($_0xd55e, true);
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = is_array($_0xe3f9) ? array_values($_0xe3f9) : [$_0xd55e];
 } elseif (is_array($_0xd55e)) {
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = array_values($_0xd55e);
 } else {
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = [];
 }
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] = '';
 } elseif ($_0x21c9 === 3) {
 if (is_string($_0xd55e)) {
 $_0x4790 = json_decode($_0xd55e, true);
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = $_0x4790 !== null ? $_0x4790 : $_0xd55e;
 } else {
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = $_0xd55e;
 }
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] = '';
 } else {
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] = (string) $_0xd55e;
 $_0x8950[$_0x21d2]["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] = '';
 }
 break;
 }
 }
 }
 goto L_5af6b;
 L_75327:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x73\157\x61\154\x5f\164\x65\162\x6a\141\x77\141\x62" => $_0xa5f2, "\x74\157\x74\141\x6c\137\x73\157\x61\154" => count($_0x8950), "\x6b\141\x6d\145\x72\141\x5f\162\x65\161\x75\145\x73\164\x65\144" => $_0x8181, "\x73\145\x72\166\x65\162\x5f\164\x73" => time()]);
 L_c4a7a:
 if ($_0x3fe7 !== '' && $_0x3fe7 !== "\x30\60\x3a\60\x30\72\x30\60") {
 $_0xb6f7["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"] = $_0x3fe7;
 } else {
 $_0x6a8c = strtotime($_0xbc88->mulai ?: date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"));
 $_0x520b = max(0, time() - $_0x6a8c);
 $_0xb6f7["\x6c\141\x6d\141\x5f\165\x6a\151\x61\156"] = gmdate("\x48\72\x69\72\x73", $_0x520b);
 }
 goto L_472e3;
 L_4eaff:
 $_0xceb6 = (int) ($_0xdf6b["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? $_0xdf6b["\x6a\141\x64\167\x61\154"] ?? 0);
 goto L_60de5;
 L_d89d1:
 if (!empty($_0xdf6b["\x69\164\x65\155\x73"]) && is_array($_0xdf6b["\x69\164\x65\155\x73"])) {
 $_0x8b76 = $_0xdf6b["\x69\164\x65\155\x73"];
 } elseif (!empty($_0xdf6b["\x69\164\x65\155\x73"]) && is_string($_0xdf6b["\x69\164\x65\155\x73"])) {
 $_0x4397 = json_decode($_0xdf6b["\x69\164\x65\155\x73"], true);
 if (is_array($_0x4397)) {
 $_0x8b76 = $_0x4397;
 }
 } elseif (!empty($_0xdf6b["\x69\144\x5f\163\x6f\141\x6c"])) {
 $_0x8b76[] = ["\x69\144\x5f\163\x6f\141\x6c" => $_0xdf6b["\x69\144\x5f\163\x6f\141\x6c"], "\x6a\145\x6e\151\x73" => $_0xdf6b["\x6a\145\x6e\151\x73"] ?? 1, "\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61" => $_0xdf6b["\x6a\141\x77\141\x62\141\x6e\137\x73\151\x73\167\x61"] ?? '', "\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73" => $_0xdf6b["\x6a\141\x77\141\x62\141\x6e\137\x61\154\x69\141\x73"] ?? ''];
 }
 goto L_9d4e4;
 L_0a004:
 if ($_0xceb6 <= 0) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\112\x61\144\x77\141\x6c\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"], 400);
 }
 goto L_f6426;
 L_b7d73:
 try {
 if ($_0x91fb->tableExists("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")) {
 $_0xf623 = $_0x91fb->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->select("\x73\164\x61\164\x75\163\x2c\40\x75\160\x64\141\x74\145\x64\137\x61\164")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xceb6, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0xc818->id_siswa])->get()->getRow();
 if ($_0xf623 && in_array($_0xf623->status, ["\x72\145\x71\165\x65\163\x74\145\x64", "\x61\143\x74\151\x76\145"], true)) {
 if (time() - strtotime($_0xf623->updated_at ?? "\x32\60\x30\60\x2d\60\x31\55\x30\61") <= 45) {
 $_0x8181 = true;
 }
 }
 }
 } catch (\Throwable $_0x4997) {
 }
 goto L_75327;
 L_d9d08:
 $_0xbc88 = $_0x91fb->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xceb6, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0xc818->id_siswa])->get()->getRow();
 goto L_5b3bc;
 L_472e3:
 $_0x91fb->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0xbc88->id_cbt_siswa)->update($_0xb6f7);
 goto L_6f4b3;
 L_6a649:
 if (!is_array($_0x8950)) {
 $_0x8950 = [];
 }
 goto L_4253d;
 L_60de5:
 $_0x3fe7 = trim((string) ($_0xdf6b["\x65\154\x61\160\x73\145\x64"] ?? ''));
 goto L_0a004;
 L_43a1b:
 if (!empty($_0xbc88->selesai) || (string) $_0xbc88->status === "\x32") {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x66\157\x72\143\x65\137\x66\151\x6e\151\x73\150" => true, "\x6d\145\x73\163\x61\147\x65" => "\x55\152\x69\141\x6e\40\x74\145\x6c\141\x68\40\x64\151\x73\145\x6c\145\x73\141\x69\153\x61\156\x20\157\x6c\145\x68\40\x50\145\x6e\147\x61\167\x61\163\x2f\123\x69\163\x74\145\x6d\56"]);
 }
 goto L_70670;
 L_b0b5a:
 if (!$_0xc818) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"], 401);
 }
 goto L_bf328;
 L_bf328:
 $_0xdf6b = $this->getJsonOrPost();
 goto L_4eaff;
 L_eb728:
 $_0xc818 = $this->authenticateSiswa();
 goto L_b0b5a;
 L_f6426:
 $_0x91fb = \Config\Database::connect();
 goto L_d9d08;
 L_6f4b3:
 // Hitung jumlah soal terjawab
 $_0xa5f2 = 0;
 goto L_e6062;
 }
 // =========================================================================
 // 7. SELESAI UJIAN & KALKULASI NILAI OTOMATIS
 // =========================================================================
 public function cbt_selesai()
 {
 goto L_995e6;
 L_989ab:
 $_0x6835->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\163\x69\163\x77\141" => $_0x4498, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x4ea4])->update(["\x73\145\x6c\145\x73\141\x69" => date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73"), "\x73\164\x61\164\x75\163" => 2]);
 goto L_67c17;
 L_995e6:
 $_0x567c = $this->authenticateSiswa();
 goto L_e8e13;
 L_e8e13:
 if (!$_0x567c) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"], 401);
 }
 goto L_2a8ba;
 L_f9a09:
 return $this->jsonResponse($_0x11a1);
 L_67c17:
 try {
 (new CbtModel())->saveLog($_0x4498, $_0x4ea4, 2, "\x4d\145\x6e\171\x65\154\x65\163\x61\151\x6b\141\x6e\40\x55\152\x69\141\x6e\40\x28\101\x6e\144\x72\157\x69\144\x20\116\x61\164\x69\166\x65\51");
 } catch (\Throwable $_0xa942) {
 }
 goto L_aab72;
 L_2a8ba:
 $_0x21c8 = $this->getJsonOrPost();
 goto L_37e89;
 L_567c1:
 try {
 $_0xe1f1 = $this->olah_nilai(2, (int) $_0x567c->id_tp, (int) $_0x567c->id_smt, $_0x4498, $_0x4ea4, false);
 if ($_0xe0a6 && $_0xe1f1 && !empty($_0xe1f1->sesisiswa)) {
 $_0x4319 = $_0xe1f1->sesisiswa[0]->nilai_akhir ?? null;
 $_0xa79d = $_0xe1f1->bank ?? null;
 if ($_0x4319 && $_0xa79d) {
 $_0xdd0b = round((float) ($_0x4319->skor_total ?? $_0x4319->skor_asli ?? 0), 2);
 $_0xd679 = (int) ($_0xa79d->tampil_pg ?? 0);
 $_0xf7c6 = (int) ($_0xa79d->tampil_kompleks ?? 0);
 $_0x7996 = (int) ($_0xa79d->tampil_jodohkan ?? 0);
 $_0x7903 = (int) ($_0xa79d->tampil_isian ?? 0);
 $_0xa788 = (int) ($_0xa79d->tampil_esai ?? 0);
 $_0x579d = (int) ($_0x4319->pg_benar ?? 0);
 $_0x11ae = round((float) ($_0x4319->skor_pg["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? $_0x4319->pg_nilai ?? 0), 2);
 $_0xb94a = round((float) ($_0x4319->skor_kompleks["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0xff79 = round((float) ($_0x4319->skor_kompleks["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0x88ac = round((float) ($_0x4319->skor_jodohkan["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0xce9f = round((float) ($_0x4319->skor_jodohkan["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0x7e1f = round((float) ($_0x4319->skor_isian["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0x41d2 = round((float) ($_0x4319->skor_isian["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0xc0cf = round((float) ($_0x4319->skor_essai["\x6a\155\x6c\137\x62\145\x6e\141\x72"] ?? 0), 2);
 $_0x4a3f = round((float) ($_0x4319->skor_essai["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] ?? 0), 2);
 $_0x598c = $_0xd679 + $_0xf7c6 + $_0x7996 + $_0x7903 + $_0xa788;
 if ($_0x598c === 0) {
 $_0x598c = (int) ($_0xa79d->jml_soal ?? 0);
 }
 $_0x77aa = round($_0x579d + $_0xb94a + $_0x88ac + $_0x7e1f + $_0xc0cf, 2);
 $_0x6c9d = max(0, round($_0x598c - $_0x77aa, 2));
 $_0x6d8e = [];
 if ($_0xd679 > 0) {
 $_0x6d8e[] = ["\x6c\141\x62\145\x6c" => "\x50\151\x6c\151\x68\141\x6e\40\x47\141\x6e\144\x61", "\x73\157\x61\154" => $_0xd679, "\x62\145\x6e\141\x72" => $_0x579d, "\x6e\151\x6c\141\x69" => $_0x11ae];
 }
 if ($_0xf7c6 > 0) {
 $_0x6d8e[] = ["\x6c\141\x62\145\x6c" => "\x50\107\x20\113\x6f\155\x70\154\x65\153\x73", "\x73\157\x61\154" => $_0xf7c6, "\x62\145\x6e\141\x72" => $_0xb94a, "\x6e\151\x6c\141\x69" => $_0xff79];
 }
 if ($_0x7996 > 0) {
 $_0x6d8e[] = ["\x6c\141\x62\145\x6c" => "\x4d\145\x6e\152\x6f\144\x6f\150\x6b\141\x6e", "\x73\157\x61\154" => $_0x7996, "\x62\145\x6e\141\x72" => $_0x88ac, "\x6e\151\x6c\141\x69" => $_0xce9f];
 }
 if ($_0x7903 > 0) {
 $_0x6d8e[] = ["\x6c\141\x62\145\x6c" => "\x49\163\x69\141\x6e\40\x53\151\x6e\147\x6b\141\x74", "\x73\157\x61\154" => $_0x7903, "\x62\145\x6e\141\x72" => $_0x7e1f, "\x6e\151\x6c\141\x69" => $_0x41d2];
 }
 if ($_0xa788 > 0) {
 $_0x6d8e[] = ["\x6c\141\x62\145\x6c" => "\x55\162\x61\151\x61\156\x20\57\x20\105\x73\141\x69", "\x73\157\x61\154" => $_0xa788, "\x62\145\x6e\141\x72" => $_0xc0cf, "\x6e\151\x6c\141\x69" => $_0x4a3f];
 }
 $_0x11a1["\x73\153\x6f\162\x5f\164\x6f\164\x61\154"] = $_0xdd0b;
 $_0x11a1["\x6a\155\x6c\137\x73\157\x61\154"] = $_0x598c;
 $_0x11a1["\x74\157\x74\141\x6c\137\x62\145\x6e\141\x72"] = $_0x77aa;
 $_0x11a1["\x74\157\x74\141\x6c\137\x73\141\x6c\141\x68"] = $_0x6c9d;
 $_0x11a1["\x62\162\x65\141\x6b\144\x6f\167\x6e"] = $_0x6d8e;
 }
 }
 } catch (\Throwable $_0xa942) {
 }
 goto L_f9a09;
 L_8df9a:
 $_0x4498 = (int) $_0x567c->id_siswa;
 goto L_989ab;
 L_aab72:
 $_0x345b = $_0x6835->table("\x63\142\x74\137\x6a\141\x64\167\x61\154")->where("\x69\144\x5f\152\x61\144\x77\141\x6c", $_0x4ea4)->get()->getRow();
 goto L_9d2cd;
 L_e052a:
 if ($_0x4ea4 <= 0) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x49\104\x20\112\x61\144\x77\141\x6c\40\x74\151\x64\141\x6b\40\x76\141\x6c\151\x64"], 400);
 }
 goto L_fbd19;
 L_37e89:
 $_0x4ea4 = (int) ($_0x21c8["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? $_0x21c8["\x6a\141\x64\167\x61\154"] ?? 0);
 goto L_e052a;
 L_fbd19:
 // Jika masih ada jawaban di payload items, simpan dulu
 if (!empty($_0x21c8["\x69\164\x65\155\x73"])) {
 $this->cbt_simpan_jawaban();
 }
 goto L_25211;
 L_9d2cd:
 $_0xe0a6 = (string) ($_0x345b->hasil_tampil ?? "\x30") === "\x31";
 goto L_9f278;
 L_25211:
 $_0x6835 = \Config\Database::connect();
 goto L_8df9a;
 L_9f278:
 $_0x11a1 = ["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x55\152\x69\141\x6e\40\x62\145\x72\150\x61\163\x69\154\x20\144\x69\163\x65\154\x65\163\x61\151\x6b\141\x6e\41", "\x68\141\x73\151\x6c\137\x74\141\x6d\160\x69\154" => $_0xe0a6, "\x73\153\x6f\162\x5f\164\x6f\164\x61\154" => null, "\x74\157\x74\141\x6c\137\x62\145\x6e\141\x72" => null, "\x74\157\x74\141\x6c\137\x73\141\x6c\141\x68" => null, "\x6a\155\x6c\137\x73\157\x61\154" => null, "\x62\162\x65\141\x6b\144\x6f\167\x6e" => []];
 goto L_567c1;
 }
 // =========================================================================
 // 8. ANTI-CHEAT, PELANGGARAN, LEAVE, VERIFY EXIT & LIVE KAMERA PENGAWAS
 // =========================================================================
 public function cbt_pelanggaran()
 {
 goto L_b3884;
 L_5140a:
 if (!$_0x7adb) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"], 401);
 }
 goto L_e3147;
 L_9d6e4:
 $_0x195b = $this->maybe_unserialize($_0x4f68->pelanggaran ?? "\x7b\175");
 goto L_f6de9;
 L_b3884:
 $_0x7adb = $this->authenticateSiswa();
 goto L_5140a;
 L_2b7f2:
 if (!$_0x4f68) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x20\165\x6a\151\x61\156\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156"]);
 }
 goto L_9d6e4;
 L_c8d87:
 $_0x7653 = trim((string) ($_0x9466["\x6a\145\x6e\151\x73"] ?? "\x73\145\x64\141\x6e\147"));
 goto L_0ced6;
 L_089e0:
 $_0x5d89->table("\x63\142\x74\137\x73\151\x73\167\x61")->where("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141", $_0x4f68->id_cbt_siswa)->update(["\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => json_encode($_0x195b)]);
 goto L_46487;
 L_f6de9:
 if (!is_object($_0x195b)) {
 $_0x195b = (object) ["\x72\151\x6e\147\x61\156" => 0, "\x73\145\x64\141\x6e\147" => 0, "\x62\145\x72\141\x74" => 0];
 }
 goto L_55b58;
 L_0ced6:
 // ringan, sedang, berat
 if (!in_array($_0x7653, ["\x72\151\x6e\147\x61\156", "\x73\145\x64\141\x6e\147", "\x62\145\x72\141\x74"], true)) {
 $_0x7653 = "\x73\145\x64\141\x6e\147";
 }
 goto L_cf216;
 L_cf216:
 $_0x5d89 = \Config\Database::connect();
 goto L_e37b9;
 L_b6d59:
 $_0x195b->berat = (int) ($_0x195b->berat ?? 0);
 goto L_66d25;
 L_e37b9:
 $_0x4f68 = $_0x5d89->table("\x63\142\x74\137\x73\151\x73\167\x61")->select("\x69\144\x5f\143\x62\164\x5f\163\x69\163\x77\141\x2c\40\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e")->where(["\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x7adb->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0xe57c])->get()->getRow();
 goto L_2b7f2;
 L_e3147:
 $_0x9466 = $this->getJsonOrPost();
 goto L_ae403;
 L_46487:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x70\145\x6c\141\x6e\147\x67\141\x72\141\x6e" => $_0x195b]);
 L_ae403:
 $_0xe57c = (int) ($_0x9466["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? $_0x9466["\x6a\141\x64\167\x61\154"] ?? 0);
 goto L_c8d87;
 L_22387:
 $_0x195b->sedang = (int) ($_0x195b->sedang ?? 0);
 goto L_b6d59;
 L_66d25:
 $_0x195b->{$_0x7653} += 1;
 goto L_089e0;
 L_55b58:
 $_0x195b->ringan = (int) ($_0x195b->ringan ?? 0);
 goto L_22387;
 }
 public function cbt_leave()
 {
 goto L_c660c;
 L_d217f:
 $_0xb387->table("\x63\142\x74\137\x73\151\x73\167\x61")->where(["\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x8aa3->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x9516])->update(["\x72\145\x73\145\x74\137\x69\172\x69\156" => 0]);
 goto L_beb55;
 L_f19c8:
 $_0xb387 = \Config\Database::connect();
 goto L_1d13f;
 L_41510:
 $_0x9516 = (int) ($_0x84cb["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? $_0x84cb["\x6a\141\x64\167\x61\154"] ?? 0);
 goto L_f19c8;
 L_1d13f:
 $_0x7675 = $_0xb387->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where(["\x69\144\x5f\163\x69\163\x77\141" => (int) $_0x8aa3->id_siswa, "\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x9516, "\x6c\157\x67\137\x74\171\x70\145" => "\x31"])->get()->getRow();
 goto L_1a60a;
 L_3cf7f:
 $_0x84cb = $this->getJsonOrPost();
 goto L_41510;
 L_2ec13:
 if (!$_0x8aa3) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x55\156\x61\165\x74\150\x6f\162\x69\172\x65\144"], 401);
 }
 goto L_3cf7f;
 L_1a60a:
 if ($_0x7675) {
 $_0xb387->table("\x6c\157\x67\137\x75\152\x69\141\x6e")->where("\x69\144\x5f\154\x6f\147", $_0x7675->id_log)->update(["\x61\147\x65\156\x74" => "\x69\154\x6c\145\x67\141\x6c\40\x61\147\x65\156\x74", "\x64\145\x76\151\x63\145" => "\x69\154\x6c\145\x67\141\x6c\40\x64\145\x76\151\x63\145"]);
 }
 goto L_d217f;
 L_beb55:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x6d\145\x73\163\x61\147\x65" => "\x41\153\x75\156\x20\165\x6a\151\x61\156\x20\144\x69\153\x75\156\x63\151\x20\144\x61\156\x20\155\x65\155\x65\162\x6c\165\x6b\141\x6e\40\x52\145\x73\145\x74\40\x49\172\x69\156\x20\120\x65\156\x67\141\x77\141\x73"]);
 L_c660c:
 $_0x8aa3 = $this->authenticateSiswa();
 goto L_2ec13;
 }
 public function cbt_verify_exit()
 {
 goto L_aceac;
 L_97d20:
 $_0x9a24 = WRITEPATH . "\x6b\151\x6f\163\x6b\137\x65\170\x69\164\x5f\143\x6f\144\x65\56\x6a\163\x6f\156";
 goto L_1caf2;
 L_7f57f:
 $_0x2bdf = array_filter([$_0x6f7d, $_0xce4e, "\x31\62\x33\64\x35\66", "\x41\104\x4d\111\x4e\61\x32\63", "\x41\104\x4d\111\x4e\62\x30\62\x36", "\x43\102\x54\62\x30\62\x36", "\x47\101\x52\125\x44\101\x32\60\x32\66", "\x43\102\x54" . date("\x64\155")]);
 goto L_167b4;
 L_8842f:
 $_0xce4e = $_0xa86c ? strtoupper(trim((string) ($_0xa86c->token ?? ''))) : '';
 goto L_7f57f;
 L_e2375:
 $_0x6f7d = '';
 goto L_97d20;
 L_fab43:
 $_0xa86c = $_0x6387->tableExists("\x63\142\x74\137\x74\157\x6b\145\x6e") ? $_0x6387->table("\x63\142\x74\137\x74\157\x6b\145\x6e")->get()->getRow() : null;
 goto L_8842f;
 L_2aade:
 if ($_0x51da === '') {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4b\157\x64\145\x20\153\x65\154\x75\141\x72\40\x74\151\x64\141\x6b\40\x62\157\x6c\145\x68\40\x6b\157\x73\157\x6e\147\x21"]);
 }
 goto L_e2375;
 L_167b4:
 $_0x4879 = in_array($_0x51da, $_0x2bdf, true);
 goto L_cd0f2;
 L_aceac:
 $_0x54cb = $this->getJsonOrPost();
 goto L_428bb;
 L_f0078:
 $_0x6387 = \Config\Database::connect();
 goto L_fab43;
 L_1caf2:
 if (file_exists($_0x9a24)) {
 $_0x8396 = json_decode((string) file_get_contents($_0x9a24), true);
 $_0x6f7d = strtoupper(trim((string) ($_0x8396["\x63\157\x64\145"] ?? '')));
 }
 goto L_f0078;
 L_cd0f2:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => $_0x4879, "\x6d\145\x73\163\x61\147\x65" => $_0x4879 ? "\x4b\157\x64\145\x20\166\x61\154\x69\144\x2c\40\x6b\165\x6e\143\x69\40\x6c\141\x79\141\x72\40\x64\151\x62\165\x6b\141\x2e" : "\x4b\157\x64\145\x20\153\x65\154\x75\141\x72\40\x70\145\x6e\147\x61\167\x61\163\x20\163\x61\154\x61\150\x21"]);
 L_428bb:
 $_0x51da = strtoupper(trim((string) ($_0x54cb["\x63\157\x64\145"] ?? '')));
 goto L_2aade;
 }
 public function cbt_kamera_frame()
 {
 goto L_08590;
 L_adab2:
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => true, "\x61\143\x74\151\x76\145" => $_0xd55d]);
 L_5c7bd:
 $_0x8352 = \Config\Database::connect();
 goto L_4adff;
 L_3c56e:
 $_0x5d7d = $this->getJsonOrPost();
 goto L_e132e;
 L_c949f:
 $_0xd55d = false;
 goto L_7fa63;
 L_08590:
 $_0xdab1 = $this->authenticateSiswa();
 goto L_10882;
 L_e132e:
 $_0x2c67 = (int) ($_0x5d7d["\x69\144\x5f\152\x61\144\x77\141\x6c"] ?? 0);
 goto L_9dae0;
 L_ed8ec:
 if ($_0x2c67 <= 0 || $_0x54b5 === '') {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x61\143\x74\151\x76\145" => false]);
 }
 goto L_5c7bd;
 L_9dae0:
 $_0x54b5 = (string) ($_0x5d7d["\x66\162\x61\155\x65"] ?? '');
 goto L_ed8ec;
 L_7fa63:
 try {
 if ($_0x8352->tableExists("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")) {
 $_0x880f = $_0x8352->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->select("\x73\164\x61\164\x75\163\x2c\40\x75\160\x64\141\x74\145\x64\137\x61\164")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x2c67, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0xdab1->id_siswa])->get()->getRow();
 if ($_0x880f) {
 if (in_array($_0x880f->status, ["\x72\145\x71\165\x65\163\x74\145\x64", "\x61\143\x74\151\x76\145"], true)) {
 if (time() - strtotime($_0x880f->updated_at ?? "\x32\60\x30\60\x2d\60\x31\55\x30\61") <= 45) {
 $_0xd55d = true;
 }
 }
 $_0x8352->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->where(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x2c67, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0xdab1->id_siswa])->update(["\x6c\141\x73\164\x5f\146\x72\141\x6d\145" => $_0x54b5, "\x73\164\x61\164\x75\163" => $_0xd55d ? "\x61\143\x74\151\x76\145" : "\x73\164\x61\156\x64\142\x79", "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0xd55d ? $_0x880f->updated_at : $_0xa61f]);
 } else {
 $_0x8352->table("\x63\142\x74\137\x6b\141\x6d\145\x72\141\x5f\163\x74\162\x65\141\x6d")->insert(["\x69\144\x5f\152\x61\144\x77\141\x6c" => $_0x2c67, "\x69\144\x5f\163\x69\163\x77\141" => (int) $_0xdab1->id_siswa, "\x73\164\x61\164\x75\163" => "\x73\164\x61\156\x64\142\x79", "\x6c\141\x73\164\x5f\146\x72\141\x6d\145" => $_0x54b5, "\x75\160\x64\141\x74\145\x64\137\x61\164" => $_0xa61f]);
 }
 }
 } catch (\Throwable $_0xb25d) {
 }
 goto L_adab2;
 L_4adff:
 $_0xa61f = date("\x59\55\x6d\55\x64\40\x48\72\x69\72\x73");
 goto L_c949f;
 L_10882:
 if (!$_0xdab1) {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false], 401);
 }
 goto L_3c56e;
 }
 // =========================================================================
 // 9. MODUL KBM (MATERI, TUGAS, JADWAL PELAJARAN, & PRESENSI)
 // =========================================================================
 public function kbm_materi_tugas()
 {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4d\157\x64\165\x6c\40\x4b\102\x4d\40\x74\151\x64\141\x6b\40\x61\153\x74\151\x66"]);
 }
 public function kbm_kirim_tugas()
 {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4d\157\x64\165\x6c\40\x54\165\x67\141\x73\40\x74\151\x64\141\x6b\40\x61\153\x74\151\x66"]);
 }
 public function kbm_jadwal_presensi()
 {
 return $this->jsonResponse(["\x73\164\x61\164\x75\163" => false, "\x6d\145\x73\163\x61\147\x65" => "\x4d\157\x64\165\x6c\40\x50\162\x65\163\x65\156\x73\151\x20\164\x69\144\x61\153\x20\141\x6b\164\x69\146"]);
 }
}