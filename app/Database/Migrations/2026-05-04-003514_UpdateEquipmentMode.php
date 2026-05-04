<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEquipmentMode extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_equipment', [
            'mode_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
                'after' => 'status_equipment',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_equipment', ['mode_equipment']);
    }
}
