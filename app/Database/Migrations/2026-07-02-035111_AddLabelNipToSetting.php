<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLabelNipToSetting extends Migration
{
    public function up()
    {
        // Tambah kolom label_nip jika belum ada
        $fields = $this->db->getFieldNames('setting');
        if (!in_array('label_nip', $fields)) {
            $this->forge->addColumn('setting', [
                'label_nip' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => false,
                    'default'    => 'NIP',
                    'after'      => 'nip',
                ],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('setting', 'label_nip');
    }
}
