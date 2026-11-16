<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'active', 'first_name', 'last_name', 'ip_address', 'created_on'];

    public function register($data, $group_id)
    {
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $data['created_on'] = time();
        
        $this->db->table('users')->insert($data);
        $user_id = $this->db->insertID();
        
        $this->db->table('users_groups')->insert([
            'user_id' => $user_id,
            'group_id' => $group_id
        ]);
        
        return $user_id;
    }

    public function login($username)
    {
        return $this->db->table('users a')
            ->select('a.*, b.user_id, b.group_id, c.id as role, c.name as role_name, c.description')
            ->where('a.username', $username)
            ->join('users_groups b', 'a.id=b.user_id')
            ->join('`groups` c', 'b.group_id=c.id')
            ->get()->getRow();
    }

    public function isAktif($username)
    {
        return $this->db->table('master_siswa a')
            ->select('a.id_siswa, IFNULL(b.status, 1) as status')
            ->where('a.username', $username)
            ->join('buku_induk b', 'a.id_siswa = b.id_siswa', 'left')
            ->get()->getRow();
    }

    public function cekErrorLogin($username)
    {
        return $this->db->table('login_attempts')->getWhere(['login' => $username])->getResult();
    }

    public function resetErrorLogin($username)
    {
        $this->db->table('login_attempts')->where('login', $username)->delete();
    }

    public function errorLogin($data)
    {
        $this->db->table('login_attempts')->insert($data);
    }

    public function allSiswa($ids_user)
    {
        return $this->db->table('users d')
            ->select('a.id_siswa, a.nama, a.password, a.username, a.foto, d.id, d.active')
            ->whereIn('d.id', $ids_user)
            ->join('master_siswa a', 'a.username=d.username')
            ->get()->getResult();
    }

    public function allGuru($ids_user)
    {
        return $this->db->table('master_guru a')
            ->select('a.id_guru, a.nama_guru, a.password, a.username, a.foto, d.id')
            ->whereIn('a.id_user', $ids_user)
            ->join('users d', 'a.id_user=d.id')
            ->get()->getResult();
    }

    public function all_profiles($ids_user)
    {
        return $this->db->table('users')
            ->select('id, first_name, last_name, username')
            ->whereIn('id', $ids_user)
            ->get()->getResult();
    }
}
