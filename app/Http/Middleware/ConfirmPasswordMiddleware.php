<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfirmPasswordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $password = $request->input('password');
        $confirmPassword = $request->input('confirm_password');

        if($password !== $confirmPassword){
            return response()->json([
                'error' => 'Parolni tasdiqlashda hatolik'
            ]);
        }
        return $next($request);
    }
}
