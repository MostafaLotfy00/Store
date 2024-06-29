<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectApis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token= $request->header('x-api-key');
        if($token !== config('app.api_token')){
           return response()->json([
                'message' => 'Invalid API Key'
            ], 400);
        }
        return $next($request);
    }
}
