<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('login')) {
            return $next($request);
        }

        if (\Cookie::has('remember_token')) {

            $user = \App\Models\UserModel::where(
                'remember_token',
                \Cookie::get('remember_token')
            )->first();

            if ($user) {
                session([
                    'login'    => true,
                    'id_user'  => $user->id_user,
                    'name'     => $user->name,
                    'username' => $user->username,
                    'email'    => $user->email,
                    'role'     => $user->role,
                ]);

                return $next($request);
            }
        }

        return redirect('/login')
            ->with('error', 'Silakan login terlebih dahulu.');
    }
}
