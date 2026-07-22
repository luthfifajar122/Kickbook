<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('login')) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (session('role') !== 'admin') {
            abort(403);
        }

        return $next($request);
    }
}
