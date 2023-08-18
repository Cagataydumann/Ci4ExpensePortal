<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {
            $userType = session()->get('userType');

            if ($userType === 'employee' && !session()->get('isBoth')) {
                return redirect()->to('/employee/dashboard');
            } elseif ($userType === 'admin') {
                return redirect()->to('/admin/dashboard');
            } elseif ($userType === 'manager') {
                return redirect()->to('/manager/dashboard'); // veya managerlar için uygun yönlendirme
            }
        }
    }


    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
