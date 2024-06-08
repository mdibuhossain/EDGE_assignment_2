<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $findUser = User::find(session()->get('uid'));
        if (!$findUser || $findUser->role !== 'admin') {
            return response()->json(['message' => 'You are not authorized'], 401);
        }
        return $next($request);
    }
}
