<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

use CodeIgniter\Controller;
class Update extends Controller
{
 protected $session;
 public function __construct()
 {
 $this->session = \Config\Services::session();
 helper(["\x75\162\x6c", "\x66\157\x72\155"]);
 }
 /**
 * Show update page
 * GET /update
 */
 public function index()
 {
 // Only admin or from local
 $_0x3047 = ["\x6a\163\x6f\156" => $this->getMigrationStatus()];
 return $this->renderUpdate("\x69\156\x73\164\x61\154\x6c\57\x75\160\x64\141\x74\145", $_0x3047);
 }
 /**
 * AJAX: Check if database needs update
 * GET /update/checkdatabase
 */
 public function checkDatabase()
 {
 try {
 $_0xee94 = \Config\Services::migrations();
 $_0x31fa = $_0xee94->findMigrations();
 $_0x80a2 = $_0xee94->getHistory("\x64\145\x66\141\x75\154\x74");
 $_0xc14a = array_column($_0x80a2, "\x76\145\x72\163\x69\157\x6e");
 $_0x34f9 = 0;
 foreach ($_0x31fa as $_0xf187) {
 if (!in_array($_0xf187->version, $_0xc14a)) {
 $_0x34f9++;
 }
 }
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => "\x73\165\x63\143\x65\163\x73", "\x63\157\x75\156\x74\163" => $_0x34f9, "\x6d\145\x73\163\x61\147\x65" => $_0x34f9 === 0 ? "\x44\141\x74\141\x62\141\x73\145\x20\163\x75\144\x61\150\x20\166\x65\162\x73\151\x20\164\x65\162\x62\141\x72\165" : "Ada {$_0x34f9} update database yang perlu dijalankan"]);
 } catch (\Throwable $_0x34c3) {
 return $this->response->setStatusCode(500)->setJSON(["\x73\164\x61\164\x75\163" => "\x65\162\x72\157\x72", "\x6d\145\x73\163\x61\147\x65" => $_0x34c3->getMessage()]);
 }
 }
 /**
 * AJAX: Run database migrations/updates
 * GET /update/updatedatabase
 */
 public function updateDatabase()
 {
 try {
 $_0x9748 = \Config\Services::migrations();
 $_0x9748->latest();
 return $this->response->setJSON(["\x73\164\x61\164\x75\163" => "\x73\165\x63\143\x65\163\x73", "\x6d\145\x73\163\x61\147\x65" => "\x44\141\x74\141\x62\141\x73\145\x20\142\x65\162\x68\141\x73\151\x6c\40\x64\151\x75\160\x64\141\x74\145\x20\153\x65\40\x76\145\x72\163\x69\40\x74\145\x72\142\x61\162\x75", "\x70\162\x6f\147\x72\145\x73\163" => 100]);
 } catch (\Throwable $_0xd37b) {
 return $this->response->setStatusCode(500)->setJSON(["\x73\164\x61\164\x75\163" => "\x65\162\x72\157\x72", "\x6d\145\x73\163\x61\147\x65" => $_0xd37b->getMessage()]);
 }
 }
 /**
 * POST /update (form submit fallback)
 */
 public function postUpdate()
 {
 return $this->updateDatabase();
 }
 // =========================================================
 // Private helpers
 // =========================================================
 private function renderUpdate(string $_0x1d71, array $_0x5e96 = []): string
 {
 goto L_b04cd;
 L_aed24:
 return $_0xccbe;
 L_98c00:
 $_0xccbe .= view("\x69\156\x73\164\x61\154\x6c\57\x66\157\x6f\164\x65\162", $_0x5e96);
 goto L_aed24;
 L_b04cd:
 $_0xccbe = view("\x69\156\x73\164\x61\154\x6c\57\x68\145\x61\144\x65\162", $_0x5e96);
 goto L_174ba;
 L_174ba:
 $_0xccbe .= view($_0x1d71, $_0x5e96);
 goto L_98c00;
 }
 private function getMigrationStatus(): array
 {
 try {
 $_0x4be5 = \Config\Services::migrations();
 return $_0x4be5->findMigrations();
 } catch (\Throwable $_0xadb5) {
 return [];
 }
 }
}