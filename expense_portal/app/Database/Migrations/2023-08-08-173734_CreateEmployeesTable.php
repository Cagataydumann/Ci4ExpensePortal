<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        /*
         * Create 'employees' table.
         *
         * This method creates a new database table named 'employees' to store employee information.
         * It defines the table structure, including columns like 'employee_id', 'employee_name', 'email', 'password', 'admin_id', 'department_id', and 'designation_id'.
         * 'employee_id' is an auto-incremented primary key, 'employee_name' stores the name of the employee, 'email' stores the employee's email,
         * 'password' stores the password (you might want to consider hashing), 'admin_id' references the corresponding admin, 'department_id' references the department of the employee,
         * and 'designation_id' references the designation of the employee.
         * Foreign key constraints are added for 'admin_id', 'department_id', and 'designation_id' to maintain referential integrity.
         */
        $this->forge->addField([
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
                'unique' => true,
                'charset' => 'utf8mb4',
                'collate' => 'utf8mb4_general_ci',
            ],
            'employee_name' => [
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
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'charset' => 'utf8mb4', // Karakter seti belirleme
                'collate' => 'utf8mb4_general_ci', // Collation belirleme
            ],
            'department_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'designation_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ]
        ]);

        // Primary key and foreign key definitions
        $this->forge->addPrimaryKey('employee_id');
        $this->forge->addForeignKey('admin_id','admins','admin_id','CASCADE', 'CASCADE');
        $this->forge->addForeignKey('department_id', 'departments', 'department_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('designation_id', 'designations', 'designation_id', 'CASCADE', 'CASCADE');

        // Create the employees table
        $this->forge->createTable('employees');
    }


    public function down()
    {
        //
    }
}
