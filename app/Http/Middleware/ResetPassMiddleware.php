<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResetPassMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get('userEmail');
        
        if ($user) {
           return $next($request);
            
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Unauthorized',
            ]);
        }
    }
}
