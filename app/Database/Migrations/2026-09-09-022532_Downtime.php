<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Downtime extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_downtime' => [
                'type' => 'int',
                'auto_increment' => true,
            ],
            'code_downtime' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
            ],
            'equipment_downtime' => [
                'type' => 'varchar',
                'constraint' => 200,
                'null' => false,
            ],
            'date_start_downtime' => [
                'type' => 'datetime',
                'null' => false,
            ],
            'detail_downtime' => [
                'type' => 'text',
                'null' => false,
            ],
            'status_downtime' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false,
            ],
            'date_done_downtime' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'detail_done_downtime' => [
                'type' => 'text',
                'null' => true,
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
        $this->forge->addPrimaryKey('id_downtime');
        $this->forge->createTable('tb_downtime');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_downtime');
    }
}
