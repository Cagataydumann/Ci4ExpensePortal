<?php
namespace App\Models;

use CodeIgniter\Model;

class CurrencyModel extends Model
{
    /**
     * Table name for currency.
     *
     * @var string
     */
    protected $table = 'currency';

    /**
     * Primary key field for currency.
     *
     * @var string
     */
    protected $primaryKey = 'currency_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = ['currency_name'];

    /**
     * Add a new currency type to the database.
     *
     * @param array $data Data for the new currency type
     * @return mixed Inserted ID if successful, false otherwise
     */
    public function addCurrencyType($data)
    {
        return $this->insert($data);
    }

    /**
     * Get all currency types from the database.
     *
     * @return array All currency types
     */
    public function getAllCurrencyTypes()
    {
        return $this->findAll();
    }
}

