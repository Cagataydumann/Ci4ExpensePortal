<?php

namespace App\Models;

use CodeIgniter\Model;
use function PHPUnit\Framework\throwException;

class ManagerModel extends Model
{
    /**
     * Table name for the manager data.
     *
     * @var string
     */
    protected $table = 'managers';

    /**
     * Primary key field for the manager data.
     *
     * @var string
     */
    protected $primaryKey = 'manager_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'department',
        'designation',
        'employee_id'
    ];

    /**
     * Get all managers' data.
     *
     * @return array Managers' data
     */
    public function getAllManagers()
    {
        return $this->findAll();
    }

    /**
     * Get all managers' data for DataTable.
     *
     * @return array Managers' data for DataTable
     */
    public function getAllManagersForDataTable()
    {
        return $this->db->table('managers')
            ->select('managers.manager_id, managers.name, managers.email, managers.password, departments.department_name, managers.designation')
            ->join('departments', 'departments.department_id = managers.department', 'left')
            ->get()
            ->getResult();
    }

    /**
     * Add a new manager to the database.
     *
     * @param array $data Data for the new manager
     * @return bool True if successful, false otherwise
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
     * Update manager information.
     *
     * @param int $admin_id Manager ID to be updated
     * @param array $data New data for the manager
     * @return void
     * @throws \Exception
     */
    public function updateManager($admin_id, $data)
    {
        try {
            $this->db->table('managers')->where('manager_id', $admin_id)->update($data);
        }
        catch (\Exception $e) {
            throwException($e);
        }
    }

    /**
     * Delete a manager from the database.
     *
     * @param int $manager_id Manager ID to be deleted
     * @return void
     * @throws \Exception
     */
    public function deleteManager($manager_id)
    {
        try {
            $this->db->table('managers')->where('manager_id', $manager_id)->delete();
        }
        catch (\Exception $e) {
            throwException($e);
        }
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
     * Get IDs of connected employees for a manager.
     *
     * @param int $manager_id Manager ID
     * @return array Employee IDs connected to the manager
     */
    public function getConnectedEmployees($manager_id)
    {
        $builder = $this->db->table('employees');
        $builder->select('employee_id');
        $builder->where('manager_id', $manager_id);

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
     * @param string $status New status (approved/rejected)
     * @param string $description Description of the decision
     * @return void
     */
    public function updateReportStatus($report_id, $status, $description)
    {
        $data = [
            'status' => $status,
            'description' => $description
        ];
        $this->db->table('expense_requests')
            ->where('request_id', $report_id)
            ->update($data);
    }

}
