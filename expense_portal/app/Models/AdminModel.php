<?php

namespace App\Models;

use CodeIgniter\Model;
use function PHPUnit\Framework\throwException;

class AdminModel extends Model
{
    /**
     * @var string $table
     * Admins table name
     */
    protected $table = 'admins';

    /**
     * @var string $primaryKey
     * Primary key column name
     */
    protected $primaryKey = 'admin_id';

    /**
     * @var array $allowedFields
     * List of allowed fields for mass assignment
     */
    protected $allowedFields = [
        'admin_name',
        'email',
        'password',
        'sys_admin', // Bu, sys_admin check
    ];

    /**
     * Add an employee record to the database.
     *
     * @param array $data Employee data
     * @return int Inserted employee ID
     */
    public function addEmployee($data)
    {
        $this->db->table('employees')->insert($data);
        return $this->db->insertID();
    }

    /**
     * Retrieve a list of all admins.
     *
     * @return array List of admins
     */
    public function getAllAdmins()
    {
        return $this->findAll();
    }

    /**
     * Add an admin record to the database.
     *
     * @param array $data Admin data
     * @return bool True on success, false on failure
     */
    public function addAdmin($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update an admin record in the database.
     *
     * @param int $admin_id Admin ID
     * @param array $data Admin data
     * @return void
     * @throws \Exception
     */
    public function updateAdmin($admin_id, $data)
    {
        try {
            $this->db->table('admins')->where('admin_id', $admin_id)->update($data);
        }
        catch (\Exception $e) {
            throwException($e);
        }
    }

    /**
     * Delete an admin record from the database.
     *
     * @param int $admin_id Admin ID
     * @return void
     * @throws \Exception
     */
    public function deleteAdmin($admin_id)
    {
        try {
            $this->db->table('admins')->where('admin_id', $admin_id)->delete();
        }
        catch (\Exception $e) {
            throwException($e);
        }
    }

    /**
     * Get user data by email address.
     *
     * @param string $email Email address to search for
     * @return array|null User data if found, otherwise null
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Get the IDs of employees connected to an admin.
     *
     * @param int $admin_id Admin ID
     * @return array List of employee IDs
     */
    public function getConnectedEmployees($admin_id)
    {
        $builder = $this->db->table('employees');
        $builder->select('employee_id');
        $builder->where('admin_id', $admin_id);

        $query = $builder->get();

        $employee_ids = [];
        foreach ($query->getResult() as $row) {
            $employee_ids[] = $row->employee_id;
        }

        return $employee_ids;
    }

    /**
     * Get detailed information about a selected expense report.
     *
     * @param int $report_id Expense report ID
     * @return array List of report details
     */
    public function getReportDetails($report_id)
    {
        $builder = $this->db->table('expense_requests');
        $builder->where('request_id', $report_id);

        $query = $builder->get();

        $results = $query->getResultArray();
        return $results;
    }

    /**
     * Update the status and description of an expense report.
     *
     * @param int $report_id Expense report ID
     * @param string $status New status value ('approved' or 'rejected')
     * @param string $description Description or note to be associated with the report
     * @return void
     */
    public function updateReportStatus($report_id, $status,$description)
    {
        $data = [
            'status' => $status,
            'description' => $description
        ];
        $this->db->table('expense_requests')
            ->where('request_id', $report_id)
            ->update($data);
    }
    /**
     * Get admin data in a format suitable for DataTable.
     *
     * @return array List of admin data
     */
    public function getAllAdminsForDataTable()
    {
        return $this->select('admin_id, admin_name, email')
            ->findAll();
    }

}
