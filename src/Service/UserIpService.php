<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class UserIpService
{
    public function getIp(): string
    {
        /*
        $request = Request::createFromGlobals();
        $ip = $request->getClientIp();
        */
        $ips = [//'213.24.76.1',
            '83.99.248.238',
            //'38.126.133.0'
        ]; //hardcoded ip for testing on local web server
        $ip = $ips[array_rand($ips)];
        return $ip;
    }


}