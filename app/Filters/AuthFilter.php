<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */

    protected $isAccess = [
        'ADMIN' => [
            'dashboard',
            'suppliers',
            'customers',
            'products',
            'transaction',
            'users',
            'reports',
            'logout'
        ],
        'CASHIER' => [
            'dashboard',
            'suppliers',
            'customers',
            'transaction',
            'logout'
        ]
    ];
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $uri = service('uri');

        // create isAccess
        $role = $session->get('role');
        $menu = $uri->getSegment(1);

        if (array_key_exists($role, $this->isAccess)) {
            if (!in_array($menu, $this->isAccess[$role])) {
                return redirect()->to('dashboard');
            }
        }

        // Jika pengguna sudah login dan mencoba mengakses halaman login, kembalikan ke dashboard
        if ($session->get('logged_in') && $uri->getSegment(1) === '') {
            return redirect()->to('dashboard');
        }

        // Mengecualikan halaman login dari pengecekan otentikasi
        if ($uri->getSegment(1) === '') {
            return;
        }

        if (!$session->get('logged_in')) {
            return redirect()->to('');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
