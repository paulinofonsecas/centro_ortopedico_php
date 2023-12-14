<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckResetPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // /** @var User */
        // $user = auth()->user();
        // if ($user->password_reset_required == 0) {
        //     ds('requred reset password');
        //     abort(404);
        // }

        if (auth()->user()->password_reset_required == 0) {
            return redirect('/');
            ds('aqui');
        }

        return $next($request);
    }
}
