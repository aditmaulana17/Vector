<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role_id;
      $superVisorid = Role::where('role_name', 'supervisor')->first()->id;

      // if ($role_id != $superVisorid){
      //   Alert::error('Gagal', 'Anda tidak memiliki akses ke halaman ini');
        // return redirect()->route('home');
    //   }
        return $next($request);
    }
}
