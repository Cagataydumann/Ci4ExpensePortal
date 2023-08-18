<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class EmailController extends Controller
{
    protected $employeeModel;
    protected $adminModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->adminModel = new AdminModel();
    }

    /**
     * Sends an email notification to the admin when an expense request is submitted by an employee.
     *
     * @param string $employeeEmail The email address of the employee submitting the request.
     * @param string $adminEmail The email address of the admin who will receive the notification.
     *
     * @return bool Returns true if the email is sent successfully, otherwise false.
     */
    public function sendRequestNotification($employeeEmail, $managerEmail, $requesterRole)
    {
        $session = session();
        $config = $session->get('emailConfig');
        $employeeName = $session->get('userName');
        $email = \Config\Services::email();
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'sandbox.smtp.mailtrap.io';
        $config['SMTPUser'] = 'a0bf191fae3278';
        $config['SMTPPass'] = '54fac67b765948';
        $config['SMTPPort'] = '2525';
        $email->initialize($config);
        $employeeId = $session->get('userId');

        if ($requesterRole === 'employee') {
            $managerEmail = $this->employeeModel->getAdminEmail($employeeId);
        } else {
            $managerId = $this->employeeModel->getManagerId($employeeId);
            $managerEmail = $this->employeeModel->getAdminEmail($managerId);
        }

        $email->setFrom('cgtydmn81@gmail.com', 'System');
        $email->setTo($managerEmail);
        $email->setSubject('Expense Request');
        $email->setMessage('Employee ' . $employeeName . ' has submitted an expense request.');

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Sends an email notification to the employee regarding the decision on their expense request.
     *
     * @param int $employeeId The ID of the employee who submitted the request.
     * @param int $adminId The ID of the admin who made the decision.
     * @param string $decisionText The decision text (e.g., approved or rejected).
     *
     * @return void
     */
    public function sendDecisionNotification($employeeId, $adminId, $decisionText,$description)
    {

        $session = session();
        $config = $session->get('emailConfig');
        $adminId = session()->get('userId');
        $adminEmail = session()->get('userEmail');
        $employeeEmail=$this->employeeModel->getEmployeeEmail($adminId);
        $email = \Config\Services::email();
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'sandbox.smtp.mailtrap.io';
        $config['SMTPUser'] = 'a0bf191fae3278';
        $config['SMTPPass'] = '54fac67b765948';
        $config['SMTPPort'] = '2525';
        $email->initialize($config);
        echo "Employee Email: $employeeEmail<br>";
        echo "Admin Email: $adminEmail<br>";
        if (!$employeeEmail) {
            echo "Employee email not found.";
            return;
        }
        $email->setFrom('cgtydmn81@gmail.com', 'System');
        $email->setTo($employeeEmail);
        $email->setSubject('Expense Request Decision');
        $email->setMessage(
            'Manager ' . $adminEmail . ' has ' . $decisionText . ' your expense request.' .
            PHP_EOL .
            $employeeEmail . ' has been sent.' .
            PHP_EOL .
            'Description: ' . $description
        );

        if ($email->send()) {
            echo "Email sent successfully.";
        } else {
            echo "Email could not be sent.";
            var_dump($email->printDebugger(['headers']));
        }

    }

    /**
     * Sends an email notification to the newly created employee regarding their account creation.
     *
     * @param string $employeeEmail The email address of the newly created employee.
     * @param string $adminName The name of the admin who created the account.
     *
     * @return void
     */
    public function sendEmployeeCreationNotification($employeeEmail, $adminName)
    {
        $session = session();
        $config = $session->get('emailConfig');
        $email = \Config\Services::email();
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'sandbox.smtp.mailtrap.io';
        $config['SMTPUser'] = 'a0bf191fae3278';
        $config['SMTPPass'] = '54fac67b765948';
        $config['SMTPPort'] = '2525';
        $email->initialize($config);

        $email->setFrom('cgtydmn81@gmail.com', 'System');
        $email->setTo($employeeEmail);
        $email->setSubject('Account Creation Notification');
        $email->setMessage(
            'Hello ' . $employeeEmail . ',' .
            PHP_EOL .
            'Your admin account has been used to create an employee account for you.' .
            PHP_EOL .
            'Welcome to the team!'
        );

        if ($email->send()) {
            return ['success' => true, 'message' => 'Email sent successfully.'];
        } else {
            return ['success' => false, 'message' => 'Email could not be sent.'];
        }


    }
}

