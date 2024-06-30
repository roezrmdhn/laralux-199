<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->roles !== $role) {
            // If the user is not authenticated or doesn't have the required role
            return response()->view('errors.403', [], 403);
            // return response()->json(['error' => 'Unauthorizedz'], 403);
        }

        return $next($request);
    }
}
