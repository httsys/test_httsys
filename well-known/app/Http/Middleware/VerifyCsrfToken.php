<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // Payment gateways POST straight to these from their own servers /
        // the donor's redirected browser, without our CSRF token attached.
        'donate/callback/*',
    ];
}
