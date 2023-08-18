<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\EmployeeController;

$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter' => 'noauth']);

//Common routes
$routes->get('/logout', 'AuthController::logout');
$routes->post('/auth/login', 'AuthController::login', );
$routes->group('Common', function ($routes) {
    $routes->get('email', 'EmailController::email');
});

$routes->group('both', ['filter' => 'auth'], function($routes) {
    $routes->get('expense_requests', 'EmployeeController::viewExpenseRequests');
    $routes->post('createExpenseRequest', 'EmployeeController::createExpenseRequest');
    $routes->get('getExpenseForm', 'EmployeeController::getExpenseForm');
});

$routes->group('manager', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'ManagerController::dashboard');
    $routes->get('expense_requests', 'EmployeeController::viewExpenseRequests');
    $routes->post('createExpenseRequest', 'EmployeeController::createExpenseRequest');
    $routes->get('getExpenseForm', 'EmployeeController::getExpenseForm');
    $routes->get('viewReports', 'ManagerController::viewReports');
    $routes->get('viewReportDetails/(:num)', 'ManagerController::viewReportDetails/$1');
    $routes->post('approveRejectReport/(:num)', 'ManagerController::approveRejectReport/$1');
    $routes->get('getAllEmployeesDataByManager/(:num)', 'ManagerController::getAllEmployeesDataByManager/$1');
    $routes->add('generateExpenseReport/(:num)', 'ManagerController::generateExpenseReport/$1');
    //$routes->add('generateExpenseReport/(:num)', 'ManagerController::generateExpenseReport/$1');
});

$routes->group('employee', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'EmployeeController::dashboard');
    $routes->get('expense_requests', 'EmployeeController::viewExpenseRequests');
    $routes->post('createExpenseRequest', 'EmployeeController::createExpenseRequest');
    $routes->get('getExpenseForm', 'EmployeeController::getExpenseForm');
    $routes->get('view_requests', 'EmployeeController::viewPendingExpenseRequests');
    $routes->get('approve_or_reject_request/(:num)/(:alpha)', 'EmployeeController::approveOrRejectExpenseRequest/$1/$2');
    $routes->post('approve_or_reject_request/(:num)/(:alpha)', 'EmployeeController::approveOrRejectExpenseRequest/$1/$2');
});

$routes->group('admin', ['filter' => 'auth'], function($routes) {

    $routes->get('dashboard', 'AdminController::dashboard');

    //Employee operations
    $routes->get('getAllEmployees', 'AdminController::getAllEmployees');
    $routes->get('getAllEmployeesData', 'AdminController::getAllEmployeesData');
    $routes->get('getAllManagers', 'AdminController::getAllManagers');
    $routes->get('getAllManagersData', 'AdminController::getAllManagersData');
    $routes->get('updateEmployee/(:num)', 'AdminController::updateEmployee/$1');
    $routes->post('updateEmployee/(:num)', 'AdminController::updateEmployee/$1');
    $routes->get('createEmployee', 'AdminController::createEmployee');
    $routes->match(['get','post'],'createEmployeeAccount', 'AdminController::createEmployeeAccount');
    $routes->delete('deleteEmployee/(:num)', 'AdminController::deleteEmployee/$1');
    $routes->get('updateManager/(:num)', 'AdminController::updateManager/$1');
    $routes->post('updateManager/(:num)', 'AdminController::updateManager/$1');
    $routes->delete('deleteManager/(:num)', 'AdminController::deleteManager/$1');

    // Admin operations
    $routes->get('getAllAdmins', 'AdminController::getAllAdmins');
    $routes->get('getAdminsData', 'AdminController::getAdminsData');
    $routes->get('updateAdminAccount/(:num)', 'AdminController::updateAdminAccount/$1');
    $routes->post('updateAdminAccount/(:num)', 'AdminController::updateAdminAccount/$1');
    $routes->get('addAdmin', 'AdminController::addAdmin');
    $routes->post('createAdminAccount', 'AdminController::createAdminAccount');
    $routes->delete('deleteAdminAccount/(:num)', 'AdminController::deleteAdminAccount/$1');
    $routes->post('admin/makeAdmin/(:num)', 'AdminController::makeAdmin/$1');



    // System parameters operations
    $routes->get('getCreateDesignation', 'AdminController::getCreateDesignation');
    $routes->post('CreateDesignation', 'AdminController::CreateDesignation');
    $routes->post('CreateDepartment', 'AdminController::CreateDepartment');
    $routes->get('getCreateDepartment', 'AdminController::getCreateDepartment');
    $routes->post('CreateExpenseType', 'AdminController::CreateExpenseType');
    $routes->get('getCreateExpenseType', 'AdminController::getCreateExpenseType');
    $routes->post('CreateCurrency', 'AdminController::CreateCurrency');
    $routes->get('getCreateCurrency', 'AdminController::getCreateCurrency');
    $routes->get('generate_report', 'AdminController::generateExpenseReport');
    $routes->post('approveRejectReport/(:num)', 'AdminController::approveRejectReport/$1');
    $routes->add('generateExpenseReport/(:num)', 'AdminController::generateExpenseReport/$1');
    $routes->get('viewAllExpenseReports','AdminController::viewAllExpenseReports');
    $routes->add('generateAllExpenseReports', 'AdminController::generateAllExpenseReports');
});





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
