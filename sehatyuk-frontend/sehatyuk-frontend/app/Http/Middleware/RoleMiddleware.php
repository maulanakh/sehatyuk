<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = session('user');

        if (!$user || $user['role'] !== $role) {
            return redirect('/login')->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}
