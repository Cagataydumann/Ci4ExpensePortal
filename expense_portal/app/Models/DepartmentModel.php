<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    /**
     * Table name for the department data.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * Primary key field for the department data.
     *
     * @var string
     */
    protected $primaryKey = 'department_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = ['department_name'];

    /**
     * Add a new department to the database.
     *
     * @param array $data Data for the new department
     * @return mixed Inserted ID if successful, false otherwise
     */
    public function addDepartment($data)
    {
        return $this->insert($data);
    }

    /**
     * Get all departments from the database.
     *
     * @return array All departments
     */
    public function getAllDepartments()
    {
        return $this->findAll();
    }

    // DepartmentModel içerisinde
    public function getDepartmentIDByName($department_name)
    {
        return $this->where('department_name', $department_name)->first()['department_id'];
    }

}
