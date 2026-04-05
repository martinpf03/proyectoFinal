<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Trust all proxies (necesario para Render)
     */
    protected $proxies = '*';

    /**
     * Headers correctos para detectar HTTPS detrás de proxy
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
