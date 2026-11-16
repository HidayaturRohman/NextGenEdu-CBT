<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id_setting';
    protected $returnType = 'object';

    public function getSetting()
    {
        return $this->first();
    }
}
