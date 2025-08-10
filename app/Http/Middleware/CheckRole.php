<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // هنا بقولة لو المستخدم دة عامل تسجيل دخول دلوقتى وهو بردة دور المستخدم الحالى يشابة الدور اللى باعتة اذا اسمحلة بالدخول 
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
