<?php

namespace test;

use CodeIgniter\Database\Migration;

class CreateCurrencyTable extends Migration
{
    /*
     * Create 'currency' table.
     *
     * This method creates a new database table named 'currency' to store currency information.
     * It defines the table structure, including columns like 'currency_id' and 'currency_name'.
     * 'currency_id' is an auto-incremented primary key, and 'currency_name' stores the name of the currency.
     */
    public function up()
    {
        $this->forge->addField([
            'currency_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'currency_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addPrimaryKey('currency_id');
        $this->forge->createTable('currency');
    }

    public function down()
    {
        $this->forge->dropTable('currency');
    }

}
