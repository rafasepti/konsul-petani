<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tipe = array_slice(func_get_args(), 2);

        foreach ($tipe as $t){
            $user = Auth::user()->tipe;
            if( $user == $t){
                return $next($request);
            }
        }

        return abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
    }
}
