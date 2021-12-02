<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class UserIpService
{
    public function getIp()
    {
        /*
        $request = Request::createFromGlobals();
        $ip = $request->getClientIp();
        */
        $ip = '213.24.76.1'; // hardcoded ip for testing on local web server
        return $ip;
    }


}