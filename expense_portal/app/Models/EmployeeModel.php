<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    /**
     * Table name for the employee data.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * Primary key field for the employee data.
     *
     * @var string
     */
    protected $primaryKey = 'employee_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = [
        'employee_name',
        'email',
        'password',
        'manager_id',
        'department_id',
        'designation_id',
        'is_manager'
        // Add other allowed fields here
    ];

    /**
     * Foreign key references for relationships.
     *
     * @var array
     */
    protected $foreignKeys = [
        'manager_id' => 'managers(manager_id)',
        'department_id' => 'departments(department_id)',
        'designation_id' => 'designations(designation_id)'
    ];

    /**
     * Add a new employee to the database.
     *
     * @param array $data Data for the new employee
     * @return bool|string True if successful, error message otherwise
     */
    public function addEmployee($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Delete an employee from the database.
     *
     * @param int $employee_id Employee ID to be deleted
     * @return void
     * @throws \Exception
     */
    public function deleteEmployee($employee_id)
    {
        try {
            $this->db->table('employees')->where('employee_id', $employee_id)->delete();
        }
        catch (\Exception $e) {
            throwException($e);
        }
    }

    /**
     * Get employee data by admin ID.
     *
     * @param int $manager_id Manager ID
     * @return array|null Employee data or null if not found
     */

    public function getAllEmployeesForDataTableByManager($manager_id)
    {
        $builder = $this->db->table('employees');
        $builder->select('employees.employee_id, employees.employee_name, employees.email, employees.department_id, employees.designation_id, managers.name');
        $builder->join('managers', 'employees.manager_id = managers.manager_id', 'left');

        // Departman adını almak için
        $builder->join('departments', 'employees.department_id = departments.department_id', 'left');
        $builder->select('departments.department_name AS department_name');

        // Tasarım adını almak için
        $builder->join('designations', 'employees.designation_id = designations.designation_id', 'left');
        $builder->select('designations.designation_name AS designation_name');

        // Manager'a bağlı olan employee'leri getir
        $builder->where('employees.manager_id', $manager_id);

        $query = $builder->get();

        return $query->getResult();
    }


    public function getEmployeeByAdmin($manager_id)
    {
        return $this->where('manager_id', $manager_id)->first();
    }

    /**
     * Get user data by email.
     *
     * @param string $email Email address
     * @return array|null User data or null if not found
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Get all employees with related admin data for data table.
     *
     * @return array Employees with related admin data
     */
    public function getAllEmployeesForDataTable()
    {
        $builder = $this->db->table('employees');
        $builder->select('employees.employee_id, employees.employee_name, employees.email, employees.department_id, employees.designation_id, managers.name');
        $builder->join('managers', 'employees.manager_id = managers.manager_id', 'left');

        // Departman adını almak için
        $builder->join('departments', 'employees.department_id = departments.department_id', 'left');
        $builder->select('departments.department_name AS department_name');

        // Tasarım adını almak için
        $builder->join('designations', 'employees.designation_id = designations.designation_id', 'left');
        $builder->select('designations.designation_name AS designation_name');

        $query = $builder->get();

        return $query->getResult();
    }

    /**
     * Get admin email by employee ID.
     *
     * @param int $employeeId Employee ID
     * @return string|null Admin email or null if not found
     */
    public function getAdminEmail($employeeId)
    {
        $builder = $this->db->table('employees');
        $builder->select('managers.email');
        $builder->join('managers', 'employees.manager_id = managers.manager_id', 'left');
        $builder->where('employees.employee_id', $employeeId);

        $query = $builder->get();

        $result = $query->getRow();

        if ($result) {
            return $result->email;
        }

        return null;
    }
    /**
     * Get manager ID for a given employee ID.
     *
     * @param int $employeeId Employee ID
     * @return int|null Manager ID or null if not found
     */
    public function getManagerId($employeeId)
    {
        $query = $this->db->table('employees')->select('manager_id')->where('employee_id', $employeeId)->get();
        $result = $query->getRow();

        if ($result) {
            return $result->manager_id;
        }

        return null;
    }

    /**
     * Get employee email by admin ID.
     *
     * @param int $managerId Manager ID
     * @return string|null Employee email or null if not found
     */
    public function getEmployeeEmail($managerId)
    {
        $builder = $this->db->table('managers');
        $builder->select('employees.email');
        $builder->join('employees', 'managers.manager_id = employees.manager_id', 'left');
        $builder->where('managers.manager_id', $managerId);

        $query = $builder->get();

        $result = $query->getRow();

        if ($result) {
            return $result->email;
        }

        return null;
    }

}
