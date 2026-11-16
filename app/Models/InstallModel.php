<?php

namespace App\Models;

use CodeIgniter\Model;

class InstallModel extends Model
{
    public function installSuccess()
    {
        return $this->checkInstaller() === '0';
    }

    public function checkInstaller()
    {
        try {
            // Cek file penanda instalasi
            if (!file_exists(WRITEPATH . 'installed.txt')) {
                return '1'; // Belum selesai instalasi
            }

            $db = \Config\Database::connect();
            
            if (!$db->tableExists('users')) {
                return '2'; // Belum ada tabel users
            }

            $user = $db->table('users')->get()->getRow();
            if (!$user) {
                return '3'; // Belum ada user administrator
            }

            if ($db->tableExists('setting')) {
                $setting = $db->table('setting')->get()->getRow();
                if ($setting) {
                    return '0'; // Sudah terinstal lengkap
                } else {
                    return '4'; // Belum ada data sekolah
                }
            } else {
                return '4';
            }
        } catch (\Throwable $e) {
            return '1'; // Database belum terhubung
        }
    }
}
