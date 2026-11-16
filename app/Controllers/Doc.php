<?php
/*   ________________________________________
    |               NextGen Garuda CBT       |
    |    Protected & Distributed via GitHub  |
    |________________________________________|
*/
namespace App\Controllers;

class Doc extends BaseController
{
 public function index()
 {
 goto L_89a5a;
 L_89a5a:
 $_0x3d26 = FCPATH . "\x44\157\x63\57\x69\156\x64\145\x78\56\x68\164\x6d\154";
 goto L_9db9c;
 L_1e1ee:
 return "\x46\151\x6c\145\x20\144\x6f\153\x75\155\x65\156\x74\141\x73\151\x20\164\x69\144\x61\153\x20\144\x69\164\x65\155\x75\153\x61\156\x2e";
 L_9db9c:
 if (file_exists($_0x3d26)) {
 return readfile($_0x3d26);
 }
 goto L_1e1ee;
 }
}