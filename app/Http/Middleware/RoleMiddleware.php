<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request. Contoh: middleware('role:Pemilik,Karyawan')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $role = Auth::user()->role ?? null;

        if (!in_array($role, $roles)) {
            $tujuan = $role === 'Pelanggan' ? '/' : 'panel';
            return redirect($tujuan)->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
