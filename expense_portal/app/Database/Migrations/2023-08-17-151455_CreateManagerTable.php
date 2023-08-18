<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateManagerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'manager_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'designation' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addPrimaryKey('manager_id');
        $this->forge->createTable('managers');
    }

    public function down()
    {
        $this->forge->dropTable('managers');
    }
}
