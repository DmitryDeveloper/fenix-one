<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Exception;

class IsLogin
{
    /**
     * Throw Exception when user is not authenticated
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            return $next($request);
        }

        throw new Exception('You should log in system');
    }
}
