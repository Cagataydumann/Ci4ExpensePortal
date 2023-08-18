<?php
namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    /**
     * Table name for the expense request data.
     *
     * @var string
     */
    protected $table = 'expense_requests';

    /**
     * Primary key field for the expense request data.
     *
     * @var string
     */
    protected $primaryKey = 'request_id';

    /**
     * Fields that are allowed to be inserted or updated.
     *
     * @var array
     */
    protected $allowedFields = [
        'employee_id',
        'expense_date',
        'expense_type',
        'company_name',
        'amount',
        'currency',
        'bill_attachment',
        'status',
        'description',
    ];

    /**
     * Add a new expense request to the database.
     *
     * @param array $data Data for the new expense request
     * @return mixed Inserted ID if successful, false otherwise
     */
    public function addExpenseRequest($data)
    {
        return $this->insert($data);
    }

    /**
     * Get expense requests by employee ID and status.
     *
     * @param int $employee_id Employee ID
     * @param string $status Status of the expense requests
     * @return array Matching expense requests
     */
    public function getRequestsByEmployeeIdAndStatus($employee_id, $status)
    {
        return $this->where('employee_id', $employee_id)
            ->where('status', $status)
            ->findAll();
    }

    /**
     * Get expense requests for data table.
     *
     * @param int $employee_id Employee ID
     * @return array Expense requests with associated employee data
     */
    public function getExpenseRequestsForDataTable($employee_id)
    {
        $builder = $this->db->table('expense_requests');
        $builder->select('expense_requests.request_id, employees.employee_name, expense_requests.expense_date, expense_requests.expense_type, expense_requests.company_name, expense_requests.amount, expense_requests.currency, expense_requests.bill_attachment, expense_requests.status, expense_requests.description');
        $builder->join('employees', 'expense_requests.employee_id = employees.employee_id', 'left');
        $builder->where('expense_requests.employee_id', $employee_id);
        $query = $builder->get();

        return $query->getResult();
    }

    /**
     * Get expense type name by ID.
     *
     * @param int $expenseTypeId Expense type ID
     * @return string Expense type name
     */
    public function getExpenseTypeNameById($expenseTypeId)
    {
        $builder = $this->db->table('expense_types');
        $builder->select('expense_type_name');
        $builder->where('expense_type_id', $expenseTypeId);
        $query = $builder->get();

        $result = $query->getRow();

        if ($result) {
            return $result->expense_type_name;
        } else {
            return '';
        }
    }
    /**
     * Get expense reports by employee ID.
     *
     * @param int $employeeId Employee ID
     * @return array Expense reports of the employee
     */
    public function getExpenseReportsByEmployee($employeeId)
    {
        return $this->where('employee_id', $employeeId)->findAll();
    }


}
