<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/*class CheckCustomeAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect()->route('connexion.index')->withErrors(['message' => 'Veuillez vous connecter.']);
        }
        return $next($request);
    }
}*/


