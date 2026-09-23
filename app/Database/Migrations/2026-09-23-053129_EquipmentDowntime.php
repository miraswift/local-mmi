<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EquipmentDowntime extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_equipment_downtime' => [
                'type' => 'int',
                'auto_increment' => true,
            ],
            'name_equipment_downtime' => [
                'type' => 'varchar',
                'constraint' => 200,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_equipment_downtime');
        $this->forge->createTable('tb_equipment_downtime');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_equipment_downtime');
    }
}
