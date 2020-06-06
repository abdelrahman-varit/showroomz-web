<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = [
        '10.192.10.0/24',
        '10.192.11.0/24'
    ];


    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = [
        Request::HEADER_X_FORWARDED_AWS_ELB,
        Request::HEADER_X_FORWARDED_PROTO,
    ];
}
