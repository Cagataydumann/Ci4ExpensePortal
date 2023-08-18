<?php

namespace App\Models;

use CodeIgniter\Model;

class DesignationModel extends Model
{
    /**
     * Table name for the designation data.
     *
     * @var string
     */
    protected $table = 'designations';

    /**
     * Primary key field for the designation data.
     *
     * @var string
     */
    protected $primaryKey = 'designation_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = ['designation_name'];

    /**
     * Add a new designation to the database.
     *
     * @param array $data Data for the new designation
     * @return mixed Inserted ID if successful, false otherwise
     */
    public function addDesignation($data)
    {
        return $this->insert($data);
    }

    /**
     * Get all designations from the database.
     *
     * @return array All designations
     */
    public function getAllDesignations()
    {
        return $this->findAll();
    }
}
