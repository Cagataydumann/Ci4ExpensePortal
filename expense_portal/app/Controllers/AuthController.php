<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\EmployeeModel;
use App\Models\ManagerModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    /**
     * Handles the login process for both admins and employees.
     * Validates the user's credentials and sets session variables upon successful login.
     * Redirects users to the appropriate dashboard after login.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the user to the appropriate dashboard.
     */
    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $employeeModel = new EmployeeModel();
        $managerModel = new ManagerModel();

        $managerUser = $managerModel->getUserByEmail($email);
        $employeeUser = $employeeModel->getUserByEmail($email);
        $adminUser = $adminModel->getUserByEmail($email);

        if ($managerUser) {
            // Manager login
            if ($managerUser && $password === $managerUser['password']) {
                $session = session();
                $session->set([
                    'isLoggedIn' => true,
                    'userType' => 'manager',
                    'userId' => $managerUser['manager_id'],
                    'userEmail' => $managerUser['email'],
                    'userName' => $managerUser['name'],
                    'employeeId' => $employeeUser ? $employeeUser['employee_id'] : null,
                ]);
                if ($employeeUser) {
                    $session->set('isBoth', true); // Set isBoth for manager user
                    return redirect()->to('/manager/dashboard');
                }
            }
        } elseif ($employeeUser) {
            // Employee login
            if ($employeeUser && $password === $employeeUser['password']) {
                $session = session();
                $session->set([
                    'isLoggedIn' => true,
                    'userType' => 'employee',
                    'userId' => $employeeUser['employee_id'],
                    'userEmail' => $employeeUser['email'],
                    'userName' => $employeeUser['employee_name'],
                    'isBoth' => $managerUser ? true : false,
                    'employeeId' => $employeeUser['employee_id'],
                ]);
                return redirect()->to('/employee/dashboard');
            }
        } elseif ($adminUser) {
            // Admin login
            if ($adminUser && $password === $adminUser['password']) {
                $session = session();
                $session->set([
                    'isLoggedIn' => true,
                    'userType' => 'admin',
                    'userId' => $adminUser['admin_id'],
                    'userEmail' => $adminUser['email'],
                    'userName' => $adminUser['admin_name'],
                ]);
                if ($employeeUser) {
                    $session->set('employeeId', $employeeUser['employee_id']);
                }
                $session->set('sys_admin', $adminUser['sys_admin']);
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }




    /**
     * Handles the user logout process.
     * Destroys the session and redirects users to the home page.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse Redirects the user to the home page after logout.
     */
    public function logout()
    {
        $session = session();
        $session->destroy();
        echo "Logout";
        return redirect()->to('/');
    }

}

