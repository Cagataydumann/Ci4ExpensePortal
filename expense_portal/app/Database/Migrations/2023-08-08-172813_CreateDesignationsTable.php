<?php

namespace test;

use CodeIgniter\Database\Migration;

class CreateDesignationsTable extends Migration
{
    public function up()
    {
        /*
         * Create 'designations' table.
         *
         * This method creates a new database table named 'designations' to store designation information.
         * It defines the table structure, including columns like 'designation_id' and 'designation_name'.
         * The primary key 'designation_id' is an auto-incremented integer, and 'designation_name' is used to store the name of the designation.
         */
        $this->forge->addField([
            'designation_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
                'unique' => true,
                'charset' => 'utf8mb4', // Karakter seti belirleme
                'collate' => 'utf8mb4_general_ci', // Collation belirleme
            ],
            'designation_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            // Add other fields here
        ]);

        $this->forge->addPrimaryKey('designation_id');
        $this->forge->createTable('designations');
    }

    /*
     * Drop 'designations' table.
     *
     * This method removes the 'designations' table from the database.
     * It is used to undo the changes made by the 'up' method during migration rollback.
     */
    public function down()
    {
        $this->forge->dropTable('designations');
    }
}
