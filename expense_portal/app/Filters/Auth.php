<?php


namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        } else {
            $userType = session()->get('userType');

            if ($userType === 'employee') {
                if ($request->uri->getSegment(1) === 'admin' && !session()->get('isBoth')) {
                    return redirect()->back()->with('error', 'Unauthorized access');
                }
            } elseif ($userType === 'admin') {
                if ($request->uri->getSegment(1) !== 'admin' || session()->get('isBoth')) {
                    return;
                } else {
                    //return redirect()->to('/admin/dashboard');
                }
            } elseif ($userType === 'manager') {
                return;
            }
        }
    }






    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
