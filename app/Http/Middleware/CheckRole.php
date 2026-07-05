<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!session()->has('role') || session('role') !== $role) {
            return redirect()->route('login')->with('error', 'Akses ditolak! Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}