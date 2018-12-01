<?php

namespace App\Http\Middleware;

use Closure;

class SkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!vaild_sk($request->input('sk')))
        {
            return response()->json([
                'status' => false,
                'errmsg' => 'Session key错误'
            ],401);
        }

        return $next($request);
    }
}
