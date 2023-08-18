<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\ExpenseModel;
use App\Models\ExpenseTypeModel;
use App\Models\CurrencyModel;
use Hermawan\DataTables;

class EmployeeController extends BaseController
{
    protected $helpers = ['form', 'url'];

    protected $filters = ['auth'];

    protected $employeeModel;
    protected $expenseModel;
    protected $ExpenseTypeModel;
    protected $currencyModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->expenseModel = new ExpenseModel();
        $this->currencyModel= new CurrencyModel();
    }

    /**
     * Displays the expense report form for employees.
     *
     * @return \CodeIgniter\HTTP\Response The view for the expense report form.
     */
    public function getExpenseForm()
    {
        if((session()->get('isBoth') == true && session()->get('userType') == 'manager') || session()->get('userType') == 'employee')
        {
            $expenseTypeModel = new ExpenseTypeModel();
            $expenseTypes = $expenseTypeModel->getAllExpenseTypes();
            $currencies = $this->currencyModel->getAllCurrencyTypes();
            return view('Employee-Views/ExpenseForm', ['expenseTypes' => $expenseTypes,'currencies' => $currencies]);
        }

    }


    /**
     * Creates a new expense request based on the submitted form data.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse The redirect response after creating the expense request.
     */
    public function createExpenseRequest()
    {
        if((session()->get('isBoth') == 1 && session()->get('userType') == 'manager') || session()->get('userType') == 'employee')
            {
                try {
                    helper(['form']);

                    if (session()->get('userType') === 'employee') {
                        $employee_id = session()->get('userId');
                    } elseif (session()->get('userType') === 'manager') {
                        $employee_id = session()->get('employeeId');
                    }
                    //$employee_id = session()->get('userId');
                    var_dump($employee_id);
                    $expense_date = $this->request->getPost('expense_date');
                    $expense_type = $this->request->getPost('expense_type');
                    $company_name = $this->request->getPost('company_name');
                    $amount = $this->request->getPost('amount');
                    $currency = $this->request->getPost('currency');
                    $bill_attachment = $this->request->getFile('bill_attachment');
                    $requesterRole = session()->get('userType') == 'manager' ? 'manager' : 'employee';
                    if ($bill_attachment->getName() !== null) {
                        $uploadPath = WRITEPATH . 'uploads';
                        $data = [
                            'employee_id' => session()->get('employeeId'),
                            'expense_date' => $expense_date,
                            'expense_type' => $expense_type,
                            'company_name' => $company_name,
                            'amount' => $amount,
                            'currency' => $currency,
                            'bill_attachment' => $bill_attachment->getName()
                        ];

                        $this->expenseModel->insert($data);
                        $bill_attachment->move($uploadPath, $bill_attachment->getName());
                        $emailController = new EmailController();
                        $employeeEmail = session()->get('userEmail');
                        $managerEmail = session()->get('userEmail');

                        $emailController->sendRequestNotification($employeeEmail, $managerEmail, $requesterRole);
                        if (session()->get('userType') == 'manager'){
                            return redirect()->to('/manager/dashboard');
                        }
                        return redirect()->to('/employee/dashboard');
                    } else {
                        return redirect()->back()->with('error', 'Please select a file to upload.');
                    }

                    return view('Employee-Views/ExpenseForm');
                }
                catch (\Exception $e) {
                    echo "Hata: " . $e->getMessage();
                }

        }
    }

    /**
     * Displays the expense requests for the employee.
     *
     * @return \CodeIgniter\HTTP\Response The view for displaying expense requests.
     */
    public function viewExpenseRequests()
    {
        if((session()->get('isBoth') == true && session()->get('userType') == 'manager') || session()->get('userType') == 'employee') {


            $expenseTypeMap = [];
            $currencyMap = [];
            try {
                if (session()->get('userType') === 'employee') {
                    $employee_id = session()->get('userId');
                } elseif (session()->get('userType') === 'manager' && session()->get('isBoth') == true) {
                    $employee_id = session()->get('employeeId');
                }
                //$employee_id = session()->get('userId');
                $pendingRequests = $this->expenseModel->getRequestsByEmployeeIdAndStatus($employee_id, 'pending');
                $approvedRequests = $this->expenseModel->getRequestsByEmployeeIdAndStatus($employee_id, 'approved');
                $rejectedRequests = $this->expenseModel->getRequestsByEmployeeIdAndStatus($employee_id, 'rejected');
                $expenseRequests = array_merge($pendingRequests, $approvedRequests, $rejectedRequests);

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

                if ($this->request->isAJAX()) {
                    $data = [
                        'expenseRequests' => $expenseRequests,
                        'expenseTypeMap' => $expenseTypeMap,
                        'currencyMap' => $currencyMap
                    ];

                    return $this->response->setJSON($data);
                } else {
                    return view('Employee-Views/expense_requests', [
                        'requests' => $expenseRequests,
                        'expenseTypeMap' => $expenseTypeMap,
                        'currencyMap' => $currencyMap
                    ]);
                }
            } catch (\Exception $e) {
                echo "Hata: " . $e->getMessage();
            }
        }
    }

    /**
     * Displays the employee dashboard.
     *
     * @return \CodeIgniter\HTTP\Response The view for the employee dashboard.
     */
    public function dashboard()
    {
        return view('employee_dashboard');
    }
}
