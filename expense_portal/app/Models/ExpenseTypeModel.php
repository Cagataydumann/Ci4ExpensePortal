<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseTypeModel extends Model
{
    /**
     * Table name for the expense type data.
     *
     * @var string
     */
    protected $table = 'expense_types';

    /**
     * Primary key field for the expense type data.
     *
     * @var string
     */
    protected $primaryKey = 'expense_type_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = ['expense_type_name'];

    /**
     * Add a new expense type to the database.
     *
     * @param array $data Data for the new expense type
     * @return mixed Inserted ID if successful, false otherwise
     */
    public function addExpenseType($data)
    {
        return $this->insert($data);
    }

    /**
     * Get all expense types from the database.
     *
     * @return array All expense types
     */
    public function getAllExpenseTypes()
    {
        return $this->findAll();
    }
}
