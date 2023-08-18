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
use \Hermawan\DataTables\DataTable;

class AdminController extends BaseController
{
    protected $helpers = ['form', 'url'];

    protected $filters = ['auth'];

    protected $adminModel;
    protected $employeeModel;

    protected $departmentModel;

    protected $designationModel;
    protected $expenseModel;
    protected $currencyModel;
    protected $managerModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->designationModel = new DesignationModel();
        $this->expenseModel = new ExpenseModel();
        $this->currencyModel = new CurrencyModel();
        $this->managerModel = new ManagerModel();

    }

    /**
     * Displays the dashboard view for the admin.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the admin to the dashboard view.
     */
    public function dashboard()
    {
        return view('admin_dashboard');
    }


    //SYSTEM OPERATIONS

    /**
     * Displays the view for creating a new department.
     *
     * @return \CodeIgniter\HTTP\Response The view for creating a new department.
     */
    public function getCreateDepartment(){
        return view('Admin-Views/add_department');
    }

    /**
     * Creates a new department based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the admin dashboard.
     */
    public function CreateDepartment(){

        $departmentModel = new DepartmentModel();

        $department_name = $this->request->getPost('department_name');

        $data = [
            'department_name' => $department_name,
        ];

        $departmentModel->addDepartment($data);
        return redirect()->to('/admin/dashboard');
    }

    /**
     * Displays the view for creating a new designation.
     *
     * @return \CodeIgniter\HTTP\Response The view for creating a new designation.
     */
    public function getCreateDesignation(){
        return view('Admin-Views/add_designation');
    }

    /**
     * Creates a new designation based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the admin dashboard.
     */
    public function CreateDesignation(){

        $designationModel = new DesignationModel();

        $designation_name = $this->request->getPost('designation_name');

        $data = [
            'designation_name' => $designation_name,
        ];

        $designationModel->addDesignation($data);
        return redirect()->to('/admin/dashboard');
    }

    /**
     * Displays the view for creating a new expense type.
     *
     * @return \CodeIgniter\HTTP\Response The view for creating a new expense type.
     */
    public function getCreateExpenseType(){
        return view('Admin-Views/add_expense_type');
    }

    /**
     * Creates a new expense type based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the admin dashboard.
     */
    public function CreateExpenseType(){

        $expenseTypeModel = new ExpenseTypeModel();

        $expense_type_name = $this->request->getPost('expense_type_name');

        $data = [
            'expense_type_name' => $expense_type_name,
        ];

        $expenseTypeModel->addExpenseType($data);
        return redirect()->to('/admin/dashboard');
    }

    /**
     * Displays the view for creating a new currency.
     *
     * @return \CodeIgniter\HTTP\Response The view for creating a new currency.
     */
    public function getCreateCurrency(){
        return view('Admin-Views/add_currency');
    }

    /**
     * Creates a new currency based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects to the admin dashboard.
     */
    public function CreateCurrency(){

        $currencyModel = new CurrencyModel();

        $currency_name = $this->request->getPost('currency_name');

        $data = [
            'currency_name' => $currency_name,
        ];

        $currencyModel->addCurrencyType($data);
        return redirect()->to('/admin/dashboard');
    }


//ADMIN OPERATION
    /**
     * Retrieves and displays a list of all administrators for DataTables.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the admin to the list administrators view.
     */
    public function getAllAdmins()
    {
        return view('Admin-Views/list_admins');
    }

    /**
     * Retrieves data of all administrators for DataTables.
     *
     * @return \CodeIgniter\HTTP\Response JSON response containing administrators' data.
     */
    public function getAdminsData()
    {
        $adminModel = new AdminModel();
        $admins = $adminModel->getAllAdminsForDataTable();

        return $this->response->setJSON(['data' => $admins]);
    }

    /**
     * Displays the view for creating a new admin.
     *
     * @return \CodeIgniter\HTTP\Response The view for creating a new admin.
     */
    public function addAdmin()
    {
        return view('Admin-Views/add_admin');
    }

    /**
     * Creates a new admin account based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\Response The response indicating success or failure of admin creation.
     */
    public function createAdminAccount()
    {
        $admin_name = $this->request->getPost('admin_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $sys_admin = 0;
        $data = [
            'admin_name' => $admin_name,
            'email' => $email,
            'password' => $password,
            'sys_admin' => $sys_admin
        ];

        if ($this->adminModel->addAdmin($data)) {
            return $this->response->setJSON(['success' => true]);
            //return redirect()->to('/admin/dashboard');
        } else {
            return $this->response->setJSON(['success' => false]);
            //return redirect()->back()->with('error', 'Admin creation failed.');
        }
    }

    /**
     * Updates an existing admin account based on the submitted form data.
     *
     * @param int $admin_id The ID of the admin to be updated.
     * @return \CodeIgniter\HTTP\Response The response indicating success or failure of admin update.
     */
    public function updateAdminAccount($admin_id)
    {

        if ($this->request->getMethod() === 'post') {
            $admin_name = $this->request->getPost('admin_name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            //$sys_admin = $this->request->getPost('sys_admin'); // Bu veriyi formdan alın
            $data = [
                'admin_name' => $admin_name,
                'email' => $email,
                'password' => $password,
            ];

            $this->adminModel->updateAdmin($admin_id, $data);
            return $this->response->setJSON(['success' => true,'redirect' => '/admin/dashboard']);
        }

        $admin = $this->adminModel->find($admin_id);
        return view('Admin-Views/update_admin', ['admin' => $admin]);
        //return redirect()->to('/admin/dashboard');
    }

    /**
     * Deletes an existing admin account.
     *
     * @param int $admin_id The ID of the admin to be deleted.
     * @return \CodeIgniter\HTTP\Response The response indicating success or failure of admin deletion.
     */
    public function deleteAdminAccount($admin_id)
    {
        if($this->request->getMethod()==='delete') {
            $this->adminModel->deleteAdmin($admin_id);
            return $this->response->setJSON(['success' => true, 'redirect' => '/admin/dashboard']);
        }

    }

    /**
     * Displays a list of all expense reports.
     *
     * This function retrieves all expense reports from the database and displays them.
     * If the request is made via AJAX, it returns JSON data for DataTables integration.
     *
     * @return \CodeIgniter\HTTP\Response The view or JSON response containing expense reports' data.
     */
    public function viewAllExpenseReports()
    {
        $expenseReportModel = new ExpenseModel();

        $allExpenseReports = $expenseReportModel->findAll();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['data' => $allExpenseReports]);
        }

        return view('Admin-Views/listAllExpenseReports', ['allExpenseReports' => $allExpenseReports]);
    }

    /**
     * Generates and offers a PDF report for all expense reports.
     *
     * This function generates a PDF report containing details of all expense reports.
     * It uses the mPDF library to create the PDF. If expense reports are available,
     * a PDF is generated and offered for download. Otherwise, an appropriate message is displayed.
     *
     * @return mixed The generated PDF report or an appropriate message.
     */
    public function generateAllExpenseReports()
    {
        $mpdf = new \Mpdf\Mpdf();

        $expenseReportModel = new ExpenseModel();
        $allExpenseReports = $expenseReportModel->findAll();

        if (!empty($allExpenseReports)) {
            $html = '<h1>All Expense Requests Report</h1>';

            $html .= '<table border="1" cellspacing="0" cellpadding="10">';
            $html .= '<tr><th>Employee ID</th><th>Request Date</th><th>Expense Type ID</th><th>Company</th><th>Amount</th><th>Currency ID</th><th>Bill</th><th>Status</th><th>Description</th></tr>';

            foreach ($allExpenseReports as $request) {
                $html .= '<tr>';
                $html .= '<td>' . $request['employee_id'] . '</td>';
                $html .= '<td>' . $request['expense_date'] . '</td>';
                $html .= '<td>' . $request['expense_type'] . '</td>';
                $html .= '<td>' . $request['company_name'] . '</td>';
                $html .= '<td>' . $request['amount'] . '</td>';
                $html .= '<td>' . $request['currency'] . '</td>';
                $html .= '<td>' . $request['bill_attachment'] . '</td>';
                $html .= '<td>' . $request['status'] . '</td>';
                $html .= '<td>' . $request['description'] . '</td>';
                $html .= '</tr>';
            }

            $html .= '</table>';
            $mpdf->WriteHTML($html);

            return $mpdf->Output('all_expense_reports.pdf', 'D');
        } else {
            // Rapor bulunamadı durumunda yapılacak işlemi burada belirtin
        }
    }



//EMPLOYEE OPERATIONS
    /**
     * Retrieves data of all managers for DataTables.
     *
     * This function retrieves data of all managers from the database and returns it as JSON
     * for DataTables integration.
     *
     * @return \CodeIgniter\HTTP\Response JSON response containing managers' data.
     */
    public function getAllManagersData()
    {
        $managerModel = new ManagerModel();
        $managers = $managerModel->getAllManagersForDataTable();
        return $this->response->setJSON(['data' => $managers]);
    }
    /**
     * Displays a list of all managers.
     *
     * This function displays a list of all managers using the associated view.
     *
     * @return \CodeIgniter\HTTP\Response The view displaying the list of managers.
     */
    public function getAllManagers()
    {
        return view('Admin-Views/list_managers');
    }
    /**
     * Retrieves data of all employees for DataTables.
     *
     * @return \CodeIgniter\HTTP\Response JSON response containing employees' data.
     */
    public function getAllEmployeesData()
    {
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->getAllEmployeesForDataTable();
        return $this->response->setJSON(['data' => $employees]);
    }

    /**
     * Displays the list of all employees.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the admin to the list employees view.
     */
    public function getAllEmployees()
    {
        return view('Admin-Views/list_employees');
    }

    /**
     * Displays the view for creating a new employee.
     *
     * @return \CodeIgniter\HTTP\Response The view for creating a new employee.
     */
    public function createEmployee()
    {
        $departments = $this->departmentModel->getAllDepartments();
        $designations = $this->designationModel->getAllDesignations();
        $managers = $this->managerModel->getAllManagers();
        //$admins = $this->adminModel->getAllAdmins();

        return view('Admin-Views/add_employee', ['departments' => $departments, 'designations' => $designations,'managers'=>$managers]);
    }

    /**
     * Creates a new employee account based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\Response The response indicating success or failure of employee creation.
     */
    public function createEmployeeAccount()
    {
        $employee_name = $this->request->getPost('employee_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $manager_id = $this->request->getPost('manager_id');
        $department_id = $this->request->getPost('department_id');
        $designation_id = $this->request->getPost('designation_id');
        $emailController = new EmailController();

            $data = [
                'employee_name' => $employee_name,
                'email' => $email,
                'password' => $password,
                'manager_id' => $manager_id,
                'department_id' => $department_id,
                'designation_id' => $designation_id,
            ];

        if ($this->employeeModel->addEmployee($data)) {
            $adminName = session()->get('userName');
            $emailController->sendEmployeeCreationNotification($email, $adminName);
            return $this->response->setJSON(['success' => true, 'redirect' => '/admin/dashboard']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create employee.', 'redirect' => '/admin/dashboard']);
        }

    }

    /**
     * Deletes an existing employee account.
     *
     * @param int $employee_id The ID of the employee to be deleted.
     * @return \CodeIgniter\HTTP\RedirectResponse The redirect response to the admin dashboard.
     */
    public function deleteEmployee($employee_id)
    {
        $this->employeeModel->deleteEmployee($employee_id);

        return redirect()->to('/admin/dashboard');
    }

    /**
     * Updates an existing employee account based on the submitted form data.
     *
     * @param int $employee_id The ID of the employee to be updated.
     * @return \CodeIgniter\HTTP\Response The response indicating success or failure of employee update.
     */
    public function updateEmployee($employee_id)
    {
        $employeeModel = new EmployeeModel();
        $managerModel = new ManagerModel();
        $departmentModel = new DepartmentModel();
        $designationModel = new DesignationModel();

        //$manager = $managerModel->find($employee_id);
        $employee = $employeeModel->find($employee_id);
        $managers = $managerModel->findAll();
        $departments = $departmentModel->getAllDepartments();
        $designations = $designationModel->getAllDesignations();

        if ($this->request->getMethod() === 'post') {
            $employee_name = $this->request->getPost('employee_name');
            $email = $this->request->getPost('email');
            $manager_id = $this->request->getPost('manager_id');
            $department_id = $this->request->getPost('department_id');
            $designation_id = $this->request->getPost('designation_id');
            $is_manager = $this->request->getPost('is_manager');
            if (session()->get('sys_admin') == 1) {
                $is_manager = $this->request->getPost('is_manager');
                $employeeData = [
                    'employee_name' => $employee_name,
                    'email' => $email,
                    'manager_id' =>$manager_id,
                    'department_id' => $department_id,
                    'designation_id' => $designation_id,
                    'is_manager' => $is_manager,
                ];
                $this->employeeModel->update($employee_id, $employeeData);
                if ($is_manager == 1) {
                    $employeePassword = $this->employeeModel->find($employee_id)['password'];
                    $managerData = [
                        'name' => $employee_name,
                        'email' => $email,
                        'password' => $employeePassword,
                        'department' => $department_id,
                        'designation' => 'Manager',
                        'employee_id' => $employee_id,
                    ];
                    $managerModel->addAdmin($managerData);
                }
            } else {
                $employeeData = [
                    'employee_name' => $employee_name,
                    'email' => $email,
                    'manager_id' =>$manager_id,
                    'department_id' => $department_id,
                    'designation_id' => $designation_id,
                ];
                $this->employeeModel->update($employee_id, $employeeData);
            }
            return $this->response->setJSON(['success' => true, 'redirect' => '/admin/dashboard']);
            //$employeeModel->update($employee_id, $employeeData);
        }
        return view('Admin-Views/update_employee', ['employee' => $employee, 'managers' => $managers, 'designations' => $designations, 'departments' => $departments]);
    }



}