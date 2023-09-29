<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        // $response->header('Access-­Control-­Expose-­Headers', 'Content-­Length-Accept-­Ranges-Content-­Range');
        // $response->header('Access-­Control-Allow-­Headers', 'range');

        return $response;
    }
}