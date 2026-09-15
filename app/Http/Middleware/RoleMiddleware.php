<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(
    Request $request,
    Closure $next,
    string ...$roles
): Response
    {
        if (!Auth::check()) {
    return redirect('/login');
}

$userRole = (int) Auth::user()->role_id;

        $allowedRoles = array_map('intval', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
