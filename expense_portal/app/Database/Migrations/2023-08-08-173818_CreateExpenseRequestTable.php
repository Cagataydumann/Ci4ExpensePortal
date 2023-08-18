<?php

namespace test;

use CodeIgniter\Database\Migration;

class CreateExpenseRequestsTable extends Migration
{
    public function up()
    {
        /*
         * Create 'expense_requests' table.
         *
         * This method creates a new database table named 'expense_requests' to store expense request information.
         * It defines the table structure, including columns like 'request_id', 'employee_id', 'expense_date', 'expense_type', 'company_name',
         * 'amount', 'currency', 'bill_attachment', 'status', and 'description'.
         * 'request_id' is an auto-incremented primary key, 'employee_id' references the corresponding employee, 'expense_date' stores the date of the expense,
         * 'expense_type' stores the type of the expense, 'company_name' stores the name of the company, 'amount' stores the expense amount,
         * 'currency' stores the currency type, 'bill_attachment' stores the filename of the bill attachment, 'status' indicates the status of the request,
         * and 'description' provides additional information about the request.
         * Foreign key constraint is added for 'employee_id' to maintain referential integrity.
         */
        $this->forge->addField([
            'request_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
                'unique' => true,
                'charset' => 'utf8mb4', // Karakter seti belirleme
                'collate' => 'utf8mb4_general_ci', // Collation belirleme
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'expense_date' => [
                'type' => 'DATE',
            ],
            'expense_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'bill_attachment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Add other fields here
        ]);
        // determining pk, fk as employees table
        $this->forge->addPrimaryKey('request_id');
        $this->forge->addForeignKey('employee_id', 'employees', 'employee_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('expense_requests');
    }

    public function down()
    {
        $this->forge->dropTable('expense_requests');
    }
}
