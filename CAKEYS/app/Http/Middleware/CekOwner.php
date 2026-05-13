<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN memiliki role 'owner'
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request); // Silakan lewat, ini Owner!
        }

        // Jika bukan owner, kembalikan ke halaman awal dengan pesan error
        return redirect('/')->with('error', 'Maaf, akses ditolak. Halaman ini khusus untuk Owner!');
    }
}
