<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class InstallFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = '';
        if (method_exists($request, 'getPath')) {
            $uri = $request->getPath();
        } elseif (method_exists($request, 'getUri')) {
            $uri = $request->getUri()->getPath();
        }
        $uri = trim($uri, '/');

        // Allow static assets, install routes, and public downloads
        if (
            $uri === 'install' ||
            strpos($uri, 'install/') === 0 ||
            strpos($uri, 'assets/') === 0 ||
            strpos($uri, 'uploads/') === 0 ||
            strpos($uri, 'downloads/') === 0 ||
            preg_match('#(^|/)install(/|$)#i', $uri) ||
            preg_match('#\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|map)$#i', $uri)
        ) {
            return null;
        }

        // Check if installation is complete
        $installedFile = WRITEPATH . 'installed.txt';
        if (!file_exists($installedFile)) {
            // Not installed yet! Seamlessly redirect to installer
            return redirect()->to(base_url('install'));
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}
