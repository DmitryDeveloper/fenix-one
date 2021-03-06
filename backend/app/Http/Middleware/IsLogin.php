<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class IsLogin
 * @package App\Http\Middleware
 */
class IsLogin
{
    /**
     * Throw Exception when user is not authenticated
     *
     * @param $request
     * @param  Closure  $next
     * @return mixed
     * @throws JWTException
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            return $next($request);
        }

        throw new JWTException('You should log in system');
    }
}
