<?php

namespace App\Http\Middleware;

use App\Constant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::check();

        if ($user && Auth::user()->role_id == Constant::ROLE_CANDIDATE)
        {
            return redirect()->route('not.found');
        }
        elseif ($user && Auth::user()->role_id == Constant::ROLE_COMPANY)
        {
            return redirect()->route('not.found');
        }
        elseif (!Auth::check())
        {
            return redirect()->route('not.found');
        }
        return $next($request);
    }
}
