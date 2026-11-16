<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    public function getDuplicateUsernames($table)
    {
        $db = \Config\Database::connect();
        return $db->table($table)
            ->select('username, COUNT(*) as total')
            ->groupBy('username')
            ->having('total >', 1)
            ->get()->getResult();
    }

    public function getUserSiswaTotalPage($search = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('master_siswa');
        if ($search) {
            $builder->groupStart()
                    ->like('nama', $search)
                    ->orLike('nisn', $search)
                    ->orLike('username', $search)
                    ->groupEnd();
        }
        return $builder->countAllResults();
    }

    public function getUserSiswaPage($tp, $smt, $offset, $limit, $search = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('master_siswa a')
            ->select('a.*, b.id_kelas, c.username as user, c.id, c.id as login_id, c.active, d.nama_kelas')
            ->join('kelas_siswa b', 'a.id_siswa=b.id_siswa AND b.id_tp=' . $db->escape($tp) . ' AND b.id_smt=' . $db->escape($smt), 'left')
            ->join('users c', 'a.username=c.username', 'left')
            ->join('master_kelas d', 'b.id_kelas=d.id_kelas', 'left');

        if ($search) {
            $builder->groupStart()
                    ->like('a.nama', $search)
                    ->orLike('a.nisn', $search)
                    ->orLike('a.username', $search)
                    ->groupEnd();
        }
        return $builder->limit($limit, $offset)->get()->getResult();
    }

    public function usernameCheck($username, $table)
    {
        $db = \Config\Database::connect();
        return $db->table($table)->where('username', $username)->get()->getResult();
    }

    public function getDataGuru($id)
    {
        $db = \Config\Database::connect();
        return $db->table('master_guru')->where('id_guru', $id)->get()->getRow();
    }

    public function getUserGuru($tp, $smt)
    {
        $db = \Config\Database::connect();
        return $db->table('master_guru a')
            ->select('a.*, c.username as user, c.id, c.id as login_id, c.active, jg.id_jabatan, lg.level, mk.nama_kelas')
            ->join('users c', 'a.username=c.username', 'left')
            ->join('jabatan_guru jg', 'a.id_guru=jg.id_guru AND jg.id_tp=' . $db->escape($tp) . ' AND jg.id_smt=' . $db->escape($smt), 'left')
            ->join('level_guru lg', 'jg.id_jabatan=lg.id_level', 'left')
            ->join('master_kelas mk', 'jg.id_kelas=mk.id_kelas', 'left')
            ->orderBy('a.nama_guru', 'asc')
            ->get()->getResult();
    }

    public function getDataSiswa($id)
    {
        $db = \Config\Database::connect();
        return $db->table('master_siswa')->where('id_siswa', $id)->get()->getRow();
    }

    public function getDetailSiswa($id, $tp, $smt)
    {
        $db = \Config\Database::connect();
        return $db->table('master_siswa a')
            ->select('a.*, b.id_kelas, c.username as user, c.id, c.id as login_id, c.active')
            ->join('kelas_siswa b', 'a.id_siswa=b.id_siswa AND b.id_tp=' . $db->escape($tp) . ' AND b.id_smt=' . $db->escape($smt), 'left')
            ->join('users c', 'a.username=c.username', 'left')
            ->where('a.id_siswa', $id)
            ->get()->getRow();
    }

    public function getDetailGuru($id)
    {
        $db = \Config\Database::connect();
        return $db->table('master_guru a')
            ->select('a.*, c.username as user, c.id, c.id as login_id, c.active')
            ->join('users c', 'a.username=c.username', 'left')
            ->where('a.id_guru', $id)
            ->get()->getRow();
    }

    public function getUsers($username)
    {
        $db = \Config\Database::connect();
        return $db->table('users')->where('username', $username)->get()->getResult();
    }

    public function getKelas($tp, $smt)
    {
        $db = \Config\Database::connect();
        return $db->table('master_kelas')
            ->where('id_tp', $tp)
            ->where('id_smt', $smt)
            ->get()->getResult();
    }

    public function getMapel()
    {
        $db = \Config\Database::connect();
        return $db->table('master_mapel')->get()->getResult();
    }

    public function getLevelGuru()
    {
        return [
            (object)['id' => '1', 'name' => 'Admin'],
            (object)['id' => '2', 'name' => 'Guru'],
            (object)['id' => '3', 'name' => 'Siswa']
        ];
    }
}


