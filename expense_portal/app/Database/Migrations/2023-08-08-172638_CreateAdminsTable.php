<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        /*
         * Create 'admins' table.
         *
         * This method creates a new database table named 'admins' to store admin information.
         * It defines the table structure, including columns like 'admin_id', 'admin_name', 'email', 'password', and 'sys_admin'.
         * The primary key 'admin_id' is an auto-incremented integer, and other fields define admin's name, email, password, and sys_admin status.
         */
        $this->forge->addField([
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
                'unique' => true,
                'charset' => 'utf8mb4', // Karakter seti belirleme
                'collate' => 'utf8mb4_general_ci', // Collation belirleme
            ],
            'admin_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'sys_admin' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
            ],
            // Add other fields here
        ]);

        $this->forge->addPrimaryKey('admin_id');
        $this->forge->createTable('admins');
    }

    /*
     * Drop 'admins' table.
     *
     * This method removes the 'admins' table from the database.
     * It is used to undo the changes made by the 'up' method during migration rollback.
     */
    public function down()
    {
        $this->forge->dropTable('admins');
    }
}

