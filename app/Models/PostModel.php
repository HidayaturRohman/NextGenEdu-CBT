<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    protected $allowedFields = ['kepada', 'dari', 'dari_group', 'text', 'tanggal', 'updated'];

    public function getPostUser($id_user)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.*, b.nama_guru, b.foto, (SELECT COUNT(post_comments.id_comment) FROM post_comments WHERE a.id_post = post_comments.id_post) AS jml');
        $builder->join('master_guru b', 'a.dari = b.id_guru', 'left');
        
        if ($id_user != 0) {
            $builder->where('a.dari', $id_user);
        }
        
        $builder->orderBy('a.updated', 'desc');
        return $builder->get()->getResult();
    }

    public function getPostForUser($kepada, $kelas = null)
    {
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.*, b.nama_guru, b.foto, (SELECT COUNT(post_comments.id_comment) FROM post_comments WHERE a.id_post = post_comments.id_post) AS jml');
        $builder->join('master_guru b', 'a.dari = b.id_guru', 'left');
        
        if ($kepada != null) {
            $builder->groupStart()
                    ->like('a.kepada', $kepada)
                    ->orLike('a.kepada', (string)$kelas)
                    ->groupEnd();
        }
        
        $builder->orderBy('a.updated', 'desc');
        return $builder->get()->getResult();
    }

    public function getIdComments($id_post)
    {
        $builder = $this->db->table('post_comments');
        $builder->select('id_comment');
        $builder->where('id_post', $id_post);
        return $builder->get()->getResult();
    }

    public function getIdReplies($id_comment)
    {
        $builder = $this->db->table('post_reply');
        $builder->select('id_reply');
        
        if (is_array($id_comment)) {
            $builder->whereIn('id_comment', $id_comment);
        } else {
            $builder->where('id_comment', $id_comment);
        }
        
        return $builder->get()->getResult();
    }
}
