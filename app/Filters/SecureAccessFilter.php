<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SecureAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Blokir semua akses kecuali dari IP tertentu (misalnya IP lokal)
        $allowed_ips = ['127.0.0.1', '::1'];
        if (!in_array($request->getIPAddress(), $allowed_ips)) {
            return service('response')->setStatusCode(403, 'Forbidden');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
