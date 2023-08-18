<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\CurrencyModel;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\ExpenseModel;
use App\Models\ExpenseTypeModel;
use App\Models\ManagerModel;
use mPDF;

class ManagerController extends BaseController {
    protected $helpers = ['form', 'url'];

    protected $filters = ['auth'];

    protected $employeeModel;
    protected $managerModel;
    protected $expenseModel;
    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
        $this->managerModel = new ManagerModel();
        $this->employeeModel = new EmployeeModel();

    }

    /**
     * Display the manager dashboard.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|\CodeIgniter\HTTP\Response|\CodeIgniter\HTTP\ResponseInterface|string
     */
    public function dashboard()
    {
        return view('manager_dashboard');
    }

    /**
     * Display details of a specific expense report.
     *
     * @param int $report_id Report ID
     * @return string
     */
    public function viewReportDetails($report_id)
    {
        $details = $this->managerModel->getReportDetails($report_id);
        $requests = $this->managerModel->getReportDetails($report_id);

        $expenseTypeModel = new ExpenseTypeModel();
        $expenseTypes = $expenseTypeModel->getAllExpenseTypes();
        foreach ($expenseTypes as $type) {
            $expenseTypeMap[$type['expense_type_id']] = $type['expense_type_name'];
        }

        $currencyModel = new CurrencyModel();
        $currencies = $currencyModel->getAllCurrencyTypes();
        foreach ($currencies as $currency) {
            $currencyMap[$currency['currency_id']] = $currency['currency_name'];
        }
        return view('Manager-Views/viewReportDetails', ['requests' => $requests, 'report_id' => $report_id,'expenseTypeMap' => $expenseTypeMap,'currencyMap' => $currencyMap]);
    }

    /**
     * Approve or reject an expense report and send notification.
     *
     * @param int $report_id Report ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function approveRejectReport($report_id)
    {
        $status = $this->request->getPost('status');
        $description = $this->request->getPost('description');
        if ($status === 'approved' || $status === 'rejected') {

            $this->managerModel->updateReportStatus($report_id, $status, $description);
        }
        $emailController = new EmailController();
        $managerId = session()->get('userId');
        //$employeeEmail = session()->get('userEmail');
        $managerEmail = session()->get('userEmail');
        $employeeEmail=$this->employeeModel->getEmployeeEmail($managerId);
        $decisionText = ($status === 'approved') ? 'approved' : 'rejected';
        $emailController->sendDecisionNotification($employeeEmail, $managerEmail, $decisionText,$description);
        return redirect()->to('/manager/viewReports');

    }

    /**
     * Display expense reports for the manager.
     *
     * @return \CodeIgniter\HTTP\Response|\CodeIgniter\HTTP\ResponseInterface|string
     */
    public function viewReports()
    {
        $manager_id = session()->get('userId');
        $employee_ids = $this->managerModel->getConnectedEmployees($manager_id);
        $requests = [];

        foreach ($employee_ids as $employee_id) {
            $employee_requests = $this->expenseModel->getExpenseRequestsForDataTable($employee_id);
            $requests = array_merge($requests, $employee_requests);
        }

        $expenseTypeModel = new ExpenseTypeModel();
        $expenseTypes = $expenseTypeModel->getAllExpenseTypes();
        foreach ($expenseTypes as $type) {
            $expenseTypeMap[$type['expense_type_id']] = $type['expense_type_name'];
        }

        $currencyModel = new CurrencyModel();
        $currencies = $currencyModel->getAllCurrencyTypes();
        $currencyMap = [];
        foreach ($currencies as $currency) {
            $currencyMap[$currency['currency_id']] = $currency['currency_name'];
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['data' => $requests]);
        } else {
            return view('Manager-Views/viewReports', ['requests' => $requests, 'expenseTypeMap' => $expenseTypeMap, 'currencyMap' => $currencyMap]);
        }
    }

    /**
     * Get all employees' data for DataTable by manager ID.
     *
     * @param int $manager_id Manager ID
     * @return \CodeIgniter\HTTP\Response
     */
    public function getAllEmployeesDataByManager($manager_id)
    {
        $employeeModel = new EmployeeModel();
        $data = $employeeModel->getAllEmployeesForDataTableByManager($manager_id);

        return $this->response->setJSON(['data' => $data]);
    }

    /**
     * Generate an expense report in PDF format.
     *
     * @param int $report_id Report ID
     * @return string
     */
    public function generateExpenseReport($report_id)
    {
        $mpdf = new \Mpdf\Mpdf();

        $managerModel = new ManagerModel();
        $report = $managerModel->getReportDetails($report_id);

        if (!empty($report)) {
            $html = '<h1>Expense Request Report</h1>';

            $html .= '<table border="1" cellspacing="0" cellpadding="10">';
            $html .= '<tr><th>Request Date</th><th>Type</th><th>Company</th><th>Amount</th><th>Currency</th><th>Bill</th><th>Status</th><th>Description</th></tr>';

            foreach ($report as $request) {
                $html .= '<tr>';
                $html .= '<td>' . $request['expense_date'] . '</td>';
                $html .= '<td>' . $request['expense_type'] . '</td>';
                $html .= '<td>' . $request['company_name'] . '</td>';
                $html .= '<td>' . $request['amount'] . '</td>';
                $html .= '<td>' . $request['currency'] . '</td>';
                $html .= '<td>' . $request['bill_attachment'] . '</td>';
                $html .= '<td>' . $request['status'] . '</td>';
                $html .= '<td>' . $request['description'] . '</td>';
                $html .= '</tr>';
                $html .= '</tr>';
            }

            $html .= '</table>';
            $mpdf->WriteHTML($html);

            return $mpdf->Output('expense_report.pdf', 'D');
        } else {

        }
    }

}