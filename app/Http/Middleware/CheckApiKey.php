<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKey
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
        // $validApiKey = config('app.api_key'); // Store this in your .env file
        
        
        // if (!$request->header('X-API-Key') || $request->header('X-API-Key') !== $validApiKey) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Invalid API key'
        //     ], 401);
        // }

        $validApiKey = config('app.api_key');
        
        if (!$request->header('X-API-Key') || $request->header('X-API-Key') !== $validApiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key'
            ], 401)->header('Access-Control-Allow-Headers', 'X-API-Key');
        }
        return $next($request);
    }
}
