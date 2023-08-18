<?php

namespace test;

use CodeIgniter\Database\Migration;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        /*
         * Create 'departments' table.
         *
         * This method creates a new database table named 'departments' to store department information.
         * It defines the table structure, including columns like 'department_id' and 'department_name'.
         * The primary key 'department_id' is an auto-incremented integer, and 'department_name' is a string.
         */
        $this->forge->addField([
            'department_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
                'unique' => true,
                'charset' => 'utf8mb4', // Karakter seti belirleme
                'collate' => 'utf8mb4_general_ci', // Collation belirleme
            ],
            'department_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            // Add other fields here
        ]);

        $this->forge->addPrimaryKey('department_id');
        $this->forge->createTable('departments');
    }

    /*
     * Drop 'departments' table.
     *
     * This method removes the 'departments' table from the database.
     * It is used to undo the changes made by the 'up' method during migration rollback.
     */
    public function down()
    {
        $this->forge->dropTable('departments');
    }
}
