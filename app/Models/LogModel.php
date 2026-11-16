<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_user', 'id_group', 'name_group', 'log_type', 'log_desc', 'address', 'agent', 'device', 'log_time'];

    public function saveLog($type, $desc)
    {
        $request = \Config\Services::request();
        $session = session();
        
        if (!$session->get('user_id')) {
            return false;
        }

        $data = [
            'id_user'    => $session->get('user_id'),
            'id_group'   => $session->get('role') ?: 1,
            'name_group' => $session->get('role_name') ?: 'admin',
            'log_type'   => $type,
            'log_desc'   => $desc,
            'address'    => $request->getIPAddress(),
            'agent'      => $request->getUserAgent()->getBrowser() . ' ' . $request->getUserAgent()->getVersion(),
            'device'     => $request->getUserAgent()->getPlatform(),
            'log_time'   => date('Y-m-d H:i:s')
        ];
        
        return $this->insert($data);
    }

    public function loadAktifitas($limit = null)
    {
        $builder = $this->db->table('log a');
        $builder->select('a.*, b.first_name, b.last_name, d.name');
        $builder->join('users b', 'b.id=a.id_user', 'left');
        $builder->join('groups d', 'd.id=a.id_group', 'left');
        if ($limit != null && $limit > 0) {
            $builder->limit($limit);
        }
        $builder->orderBy('a.log_time', 'DESC');
        return $builder->get()->getResult();
    }

    public function getCountLog($search, $filters = null)
    {
        $builder = $this->db->table('log a');
        $builder->select('a.*, b.first_name, b.last_name');
        if ($filters != null && is_array($filters)) {
            $builder->whereIn('a.id_group', $filters);
        }
        if ($search) {
            $builder->groupStart();
            $builder->like('a.name_group', $search);
            $builder->orLike('a.log_desc', $search);
            $builder->orLike('b.first_name', $search);
            $builder->orLike('b.last_name', $search);
            $builder->groupEnd();
        }

        $builder->join('users b', 'b.id=a.id_user', 'left');
        $builder->orderBy('a.log_time', 'DESC');
        return $builder->get()->getResult();
    }

    public function getLog($offset, $limit, $search, $filters = null)
    {
        $builder = $this->db->table('log a');
        $builder->select('a.*, b.first_name, b.last_name');
        if ($filters != null && is_array($filters)) {
            $builder->whereIn('a.id_group', $filters);
        }
        if ($search) {
            $builder->groupStart();
            $builder->like('a.name_group', $search);
            $builder->orLike('a.log_desc', $search);
            $builder->orLike('b.first_name', $search);
            $builder->orLike('b.last_name', $search);
            $builder->groupEnd();
        }
        
        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }
        $builder->join('users b', 'b.id=a.id_user', 'left');
        $builder->orderBy('a.log_time', 'DESC');
        return $builder->get()->getResult();
    }

    public function loadAktifitasGuru($limit = null)
    {
        $builder = $this->db->table('log a');
        $builder->select('a.*, b.first_name, b.last_name, d.name');
        $builder->join('users b', 'b.id=a.id_user', 'left');
        $builder->join('groups d', 'd.id=a.id_group', 'left');
        if ($limit != null) {
            $builder->limit($limit);
        }
        $builder->where('a.id_group', '2');
        $builder->orderBy('a.log_time', 'DESC');
        return $builder->get()->getResult();
    }

    public function loadAktifitasSiswa($limit = null)
    {
        $builder = $this->db->table('log a');
        $builder->select('a.*, b.first_name, b.last_name, d.name');
        $builder->join('users b', 'b.id=a.id_user', 'left');
        $builder->join('groups d', 'd.id=a.id_group', 'left');
        if ($limit != null) {
            $builder->limit($limit);
        }
        $builder->where('a.id_group', '3');
        $builder->orderBy('a.log_time', 'DESC');
        return $builder->get()->getResult();
    }
}





