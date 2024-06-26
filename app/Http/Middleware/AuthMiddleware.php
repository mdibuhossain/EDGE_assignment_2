<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('uid')) {
            return response()->json(['message' => 'You are not logged in'], 401);
        } else {
            $findUser = User::find(session()->get('uid'));
            if (!$findUser) {
                return response()->json(['message' => 'You are not logged in'], 401);
            }
            return $next($request);
        }
    }
}
