<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * см. https://github.com/axios/axios/issues/4094
     *
     * @param Request $request
     * @return array|string|null
     */
    protected function getTokenFromRequest($request)
    {
        //keep default behavior, use parent method first
        $token = parent::getTokenFromRequest($request);
        //if token not found we will get token from cookie
        if (!$token) {
            $token = $request->cookie('XSRF-TOKEN');
        }
        return $token;
    }
}
