<?php

namespace test;

use CodeIgniter\Database\Migration;

class CreateExpenseTypesTable extends Migration
{
    /*
     * Create 'expense_types' table.
     *
     * This method creates a new database table named 'expense_types' to store expense type information.
     * It defines the table structure, including columns like 'expense_type_id' and 'expense_type_name'.
     * The primary key 'expense_type_id' is an auto-incremented integer, and 'expense_type_name' is used to store the name of the expense type.
     */
    public function up()
    {
        $this->forge->addField([
            'expense_type_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
                'unique' => true,
                'charset' => 'utf8mb4', // Karakter seti belirleme
                'collate' => 'utf8mb4_general_ci', // Collation belirleme
            ],
            'expense_type_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            // Add other fields here
        ]);

        $this->forge->addPrimaryKey('expense_type_id');
        $this->forge->createTable('expense_types');
    }

    /*
     * Drop 'expense_types' table.
     *
     * This method removes the 'expense_types' table from the database.
     * It is used to undo the changes made by the 'up' method during migration rollback.
     */
    public function down()
    {
        $this->forge->dropTable('expense_types');
    }
}
